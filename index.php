<?php

require_once __DIR__ . '/lib/KirbyForms.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/SaveYamlAction.php';

function kirbyForms() {
  return arnoson\KirbyForms\KirbyForms::getInstance();
}

\Kirby\Cms\App::plugin('arnoson/kirby-forms', [
  'blueprints' => require __DIR__ . '/blueprints/index.php',
  'snippets' => require __DIR__ . '/snippets/index.php',
  'translations' => require __DIR__ . '/translations/index.php',
  'options' => [
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

    'label' => [
      // The submit button label.
      'submit' => 'Submit',
    ],

    'error' => [
      'invalidFields' => 'Please fill in all fields correctly',
    ],

    'success' => [
      // Wether to show a 'text' or redirect to a 'page' after a successful form
      // submission.
      'type' => 'text',
      'page' => null,
      'text' => 'Please fill in all fields correctly',
    ],

    // The confirmation email that will be sent to the submitter.
    'confirmationEmail' => [
      'enabled' => false,
      'from' => null,
      'replyTo' => null, // Uses `from` if empty.
      'subject' => 'Thank you for your registration!',
      'content' => [
        // Wether to use a text or an email template.
        'type' => 'text',
        'template' => null,
        'text' => 'We will get back to you soon.',
      ],
    ],

    // The email sent to you when the form has received a new registration.
    'notificationEmail' => [
      'enabled' => false,
      'to' => null,
      'from' => null,
      'subject' => 'New registration in {{form_name}}',
      'content' => [
        // Wether to use a text or an email template.
        'type' => 'text',
        'template' => null,
        'text' => 'We will get back to you soon.',
      ],
    ],
  ],
]);
