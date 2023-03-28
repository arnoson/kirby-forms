<?php

$blueprints = [];
foreach (glob(__DIR__ . '/**/*.yml') as $file) {
  $category = basename(dirname($file));
  $name = basename($file, '.yml');
  $blueprints["$category/$name"] = $file;
}

return array_merge($blueprints, [
  'sections/form-entries' => require __DIR__ . '/form-entries.php',
]);
