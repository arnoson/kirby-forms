<?php

namespace arnoson\KirbyForms;

class KirbyForms {
  protected static $instance = null;

  public static function getInstance() {
    return self::$instance ??= new self();
  }

  /**
   * Generate the form rules for the specified form page for use with
   * Kirby Uniform.
   *
   * @param Kirby\Cms\Page $formPage
   */
  function formRules($formPage): array {
    $formRules = [];
    foreach ($formPage->fields()->toLayouts() as $layout) {
      foreach ($layout->columns() as $column) {
        foreach ($column->blocks() as $field) {
          $rules = [
            'required' => $field->required()->toBool(),
            'min' => fieldNotEmpty($field->min()),
            'max' => fieldNotEmpty($field->max()),
            'match' => fieldNotEmpty($field->pattern()),
          ];

          // In the hidden `validators` field additional validators can be
          // stored as json. Example: ["email", "min" => 3]
          if ($field->validators()->isNotEmpty()) {
            $rules = array_merge($rules, $field->validators()->toData('json'));
          }

          $formRules[$field->name()->value()] = [
            'rules' => array_filter($rules),
          ];
        }
      }
    }
    return $formRules;
  }
}