<?php

return function () {
  $emails = option('arnoson.kirby-forms.fromEmails');

  if (!count($emails)) {
    return [
      'type' => 'info',
      'theme' => 'negative',
      'text' => 'No email addresses found',
    ];
  }

  return [
    'label' => 'Template',
    'type' => 'select',
    'options' => option('arnoson.kirby-forms.fromEmails'),
  ];
};
