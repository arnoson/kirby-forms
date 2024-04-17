<?php

return function ($kirby) {
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
    'fields' => [
      'export_form_entries' => [
        'type' => 'export-form-entries',
        'formId' => $formPage->uuid()->id(),
      ],
      'form_entries' => [],
    ],
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
        if (!preg_match('/^form-field-([\w_-]+)/', $block->type(), $match)) {
          continue;
        }
        $content = $block->content();
        $fields[$content->name()->value()] = array_merge(
          $block->content()->toArray(),
          [
            'type' => $match[1],
            'required' => $content->required()->toBool(),
          ]
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
};
