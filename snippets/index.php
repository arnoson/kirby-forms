<?php

$snippets = [];
foreach (glob(__DIR__ . '/**/*.php') as $file) {
  $category = basename(dirname($file));
  $name = basename($file, '.php');
  $snippets["$category/$name"] = $file;
}

foreach (glob(__DIR__ . '/*.php') as $file) {
  $name = basename($file, '.php');
  $snippets["$name"] = $file;
}

return $snippets;
