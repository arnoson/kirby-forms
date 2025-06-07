<?php

return function () {
  $emails = option('arnoson.kirby-forms.fromEmails');

  if (!count($emails)) {
    return [
      'type' => 'info',
      'theme' => 'negative',
      'text' => t('arnoson.kirby-forms.no-emails'),
    ];
  }

  return [
    'label' => 'arnoson.kirby-forms.email-content-template',
    'type' => 'select',
    'options' => option('arnoson.kirby-forms.fromEmails'),
  ];
};
