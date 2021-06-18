<?php
use Kirby\Data\Yaml;

return [
  'props' => [
    'value' => function ($value = null) {
      if (is_string($value)) {
        try {
          $value = Yaml::decode($value);
        } catch (\Exception $e) {
          $value = null;
        }
      }
      return $value ?? [];
    },
    'columns' => function () {
      $columns = [];

      foreach (
        $this->model()
          ->form_fields()
          ->toLayouts()
        as $layout
      ) {
        foreach ($layout->columns() as $column) {
          foreach ($column->blocks() as $field) {
            array_push($columns, [
              'name' => $field->name()->value(),
              'label' => $field->label()->value(),
            ]);
          }
        }
      }

      return $columns;
    },
  ],
  'save' => function ($value = null) {
    return Yaml::encode($value);
  },
];