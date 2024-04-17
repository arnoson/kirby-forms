<?php

use Kirby\Http\Header;
use Kirby\Http\Response;

require_once __DIR__ . '/lib/KirbyForms.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/SaveYamlAction.php';

function kirbyForms() {
  return arnoson\KirbyForms\KirbyForms::getInstance();
}

\Kirby\Cms\App::plugin('arnoson/kirby-forms', [
  'fields' => [
    'form-identifier' => ['extends' => 'slug'],
    'export-form-entries' => [
      'props' => [
        'formId' => fn($formId) => $formId,
      ],
    ],
  ],

  'blueprints' => require __DIR__ . '/blueprints/index.php',
  'snippets' => require __DIR__ . '/snippets/index.php',
  'translations' => require __DIR__ . '/translations/index.php',
  'options' => [
    // A list of email addresses that can be selected in the panel as the sender
    // of confirmation and notification emails.
    'fromEmails' => [],

    // Wether or not to use client validation (in addition to server-side
    // validation done by Kirby Uniform).
    'clientValidation' => true,

    // Wether ot not to show the old values if a form with errors is shown again.
    'showOldValues' => true,

    // How many columns to use for the grid that determines the layout of the
    // form. see: https://getkirby.com/docs/reference/panel/fields/layout#calculate-the-column-span-value
    'gridColumns' => 12,

    // Wether or not to use the `autocomplete` attribute for the form element.
    'autoComplete' => false,

    // Wether or not to use uniform's session store action. If enabled,
    // submitted forms are available as `kirby()->session()->get(formId)` where
    // `formId` can be obtained with `KirbyForms::getFormId($yourFormPage)`
    // https://kirby-uniform.readthedocs.io/en/latest/actions/session-store/
    'sessionStore' => false,
  ],

  'routes' => [
    [
      'pattern' => 'kirby-forms/export/(:any)',
      'action' => function ($formId) {
        if (
          !kirby()
            ->user()
            ?->isLoggedIn()
        ) {
          throw new Error('You need to be logged in to export form entries.');
        }

        $formPage = page("page://$formId");
        if (!$formPage) {
          throw new Error("Form page with id '$formId' not found");
        }

        Header::download([
          'mime' => 'application/csv',
          'name' => $formPage->slug() . '.csv',
          'Pragma' => 'no-cache',
          'Content-Disposition' => 'attachment',
        ]);

        $entries = $formPage->form_entries()->yaml();
        $columns = array_keys($entries['0']);

        $handle = fopen('php://output', 'w');
        fputcsv($handle, $columns);
        foreach ($entries as $entry) {
          fputcsv($handle, $entry);
        }
        fclose($handle);

        exit();
      },
    ],
  ],
]);
