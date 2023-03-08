<?php return [
  'debug' => true,
  'email' => [
    'transport' => [
      'type' => 'smtp',
      'host' => 'localhost',
      'port' => 1025,
      'security' => false,
    ],
  ],

  'arnoson.kirby-forms' => [
    'notificationEmail' => [
      'active' => true,
      'to' => 'a@s.de',
      'from' => 'a@s.de',
      'subject' => 'New registration in {{form_name}}',
    ],

    'confirmationEmail' => [
      'active' => false,
      'from' => null,
      'replyTo' => null, // Uses `from` if empty.
      'subject' => 'Thank you for your registration!',
    ],
  ],
];