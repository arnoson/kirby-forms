<?php

require_once __DIR__ . '/lib/KirbyForms.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/JsonPageAction.php';

function kirbyForms() {
  return arnoson\KirbyForms\KirbyForms::getInstance();
}

\Kirby\Cms\App::plugin('arnoson/kirby-forms', [
  'blueprints' => require __DIR__ . '/blueprints/index.php',
  'snippets' => require __DIR__ . '/snippets/index.php',
  'controllers' => require __DIR__ . '/controllers/index.php',
]);