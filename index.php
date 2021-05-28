<?php

use Kirby\Data\Json;

require_once __DIR__ . '/lib/KirbyForms.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/SaveJsonAction.php';

function kirbyForms() {
  return arnoson\KirbyForms\KirbyForms::getInstance();
}

\Kirby\Cms\App::plugin('arnoson/kirby-forms', [
  'blueprints' => require __DIR__ . '/blueprints/index.php',
  'snippets' => require __DIR__ . '/snippets/index.php',
  'controllers' => require __DIR__ . '/controllers/index.php',
  'fields' => [
    'form-entries' => [
      'props' => [
        'value' => function ($value = null) {
          if (is_string($value)) {
            try {
              $value = Json::decode($value);
            } catch (\Exception $e) {
              $value = null;
            }
          }
          return $value ?? [];
        },
        'columns' => function () {
          $columns = [];

          foreach (
            $this->model()
              ->form_fields()
              ->toLayouts()
            as $layout
          ) {
            foreach ($layout->columns() as $column) {
              foreach ($column->blocks() as $field) {
                array_push($columns, [
                  'name' => $field->name()->value(),
                  'label' => $field->label()->value(),
                ]);
              }
            }
          }

          return $columns;
        },
      ],
      'save' => function ($value = null) {
        return Json::encode($value);
      },
    ],
  ],

  'options' => [
    // The email sent to you when the form has received a new registration.
    'notificationEmail' => [
      'active' => false,
      'to' => null,
      'from' => null,
      'subject' => 'New registration in {{form_name}}',
    ],
    // The confirmation email that will be sent to the submitter.
    'confirmationEmail' => [
      'active' => false,
      'from' => null,
      'replyTo' => null, // Uses `from` if empty.
      'subject' => 'Thank you for your registration!',
    ],
  ],

  'translations' => [
    'en' => [
      'forms-json-save-error' => 'An error occurred while saving the form data',
      'arnoson.forms.no-entries' => 'No entries yet',
    ],
    'de' => [
      'forms-json-save-error' =>
        'Beim Speichern der Formulardaten ist ein Fehler aufgetreten',
    ],
  ],
]);