<?php

require_once __DIR__ . '/lib/KirbyForms.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/SaveYamlAction.php';

function kirbyForms() {
  return arnoson\KirbyForms\KirbyForms::getInstance();
}

\Kirby\Cms\App::plugin('arnoson/kirby-forms', [
  'fields' => [
    'form-identifier' => ['extends' => 'slug'],
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
]);
