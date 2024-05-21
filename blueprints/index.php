<?php

$blueprints = [];
foreach (glob(__DIR__ . '/**/*.yml') as $file) {
  $category = basename(dirname($file));
  $name = basename($file, '.yml');
  $blueprints["$category/$name"] = $file;
}

return array_merge($blueprints, [
  'pages/form-entry' => require __DIR__ . '/form-entry.php',
  'tabs/form-entries' => require __DIR__ . '/form-entries.php',
  'fields/form-email-template' => require __DIR__ . '/form-email-template.php',
  'fields/form-email-sender' => require __DIR__ . '/form-email-sender.php',
]);
