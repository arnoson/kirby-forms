<?php

$blueprints = [];
foreach (glob(__DIR__ . '/**/*.yml') as $file) {
  $category = basename(dirname($file));
  $name = basename($file, '.yml');
  $blueprints["$category/$name"] = $file;
}

return array_merge($blueprints, [
  'sections/form-entries' => function ($kirby) {
    $url = $kirby->urls()->current();
    preg_match('/\/pages\/([a-zA-Z0-9+-]+)\/?/', $url, $result);
    $slug = str_replace('+', '/', $result[1]);
    $formPage =
      page($slug) ??
      site()
        ->index()
        ->drafts()
        ->find($slug);

    $blueprint = [
      'type' => 'fields',
      'fields' => ['form_entries' => []],
    ];

    if (!$formPage) {
      $blueprint['fields']['form_entries'] = [
        'type' => 'info',
        'theme' => 'negative',
        'text' => "Couldn't find page $slug",
      ];
      return $blueprint;
    }

    $fields = [];
    foreach ($formPage->form_fields()->toLayouts() as $layout) {
      foreach ($layout->columns() as $column) {
        foreach ($column->blocks() as $block) {
          $content = $block->content();
          $fields[$content->name()->value()] = array_merge(
            $block->content()->toArray(),
            [
              'type' => explode('-', $block->type())[2],
              'required' => $content->required()->toBool(),
            ],
          );
        }
      }
    }

    if (empty($fields)) {
      $blueprint['fields']['form_entries'] = [
        'label' => 'Entries',
        'type' => 'info',
        'text' => 'No fields yet',
      ];
      return $blueprint;
    }

    $blueprint['fields']['form_entries'] = [
      'label' => 'Entries',
      'type' => 'structure',
      'fields' => $fields,
    ];
    return $blueprint;
  },
]);