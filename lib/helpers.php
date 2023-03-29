<?php

namespace arnoson\KirbyForms;

/**
 * Generate the html attributes for a form field.
 * @param Kirby\Cms\Block $field
 * @param Uniform\Form $form
 */
function formFieldAttributes(
  $id,
  $field,
  $form,
  bool $clientValidation,
  bool $showOldValues
): array {
  $name = $field->name()->value();
  $hasError = !!$form->error($name);
  $oldValue = $form->old($name);
  $default = $field->default()->value();
  $value = $showOldValues && $oldValue ? $oldValue : $default;

  $attributes = [
    'name' => $name,
    'value' => $value,
    'placeholder' => $field->placeholder()->value(),
    'step' => $field->step()->value(),
    'aria-invalid' => $hasError ? 'true' : null,
    'aria-describedby' => $hasError ? "$id/error" : null,
  ];

  if ($clientValidation) {
    $attributes = array_merge($attributes, [
      'required' => $field->required()->toBool(),
      'min' => $field->min()->value(),
      'max' => $field->max()->value(),
      'minlength' => $field
        ->min_length()
        ->or(null)
        ->value(),
      'maxlength' => $field
        ->max_length()
        ->or(null)
        ->value(),
      'pattern' => $field->pattern()->value(),
    ]);
  }

  return $attributes;
}
