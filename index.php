<?php

\Kirby\Cms\App::plugin('arnoson/kirby-forms', [
  'blueprints' => require(__dir__ . '/blueprints/index.php'),
  'snippets' => require(__DIR__ . '/snippets/index.php'),
  'templates' => require(__DIR__ . '/templates/index.php')
]);
