<?php

use Kirby\Cms\App;

App::plugin('my/custom-form-fields', [
  'blueprints' => [
    'blocks/form-field-range' => __DIR__ . '/form-field-range.yml'
  ],
  'snippets' => [
    'blocks/form-field-range' => __DIR__ . '/form-field-range.php'
  ]
]);