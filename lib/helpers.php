<?php

namespace arnoson\KirbyForms;

/**
 * Generate the html attributes for a form field.
 * @param Kirby\Cms\Block $field
 * @param Uniform\Form $form
 */
function formFieldAttributes($id, $field, $form): array {
  $name = $field->name()->value();
  $hasError = !!$form->error($name);
  $default = $field->default()->value();
  $value = $form->old($name) ?? $default;

  $attributes = [
    'name' => $name,
    'value' => $value ? $value : null,
    'placeholder' => $field->placeholder()->or(null)->value(),
    'step' => $field->step()->or(null)->value(),
    'aria-invalid' => $hasError ? 'true' : null,
    'aria-describedby' => $hasError ? "$id/error" : null,
    'required' => $field->required()->toBool(),
    'min' => $field->min()->or(null)->value(),
    'max' => $field->max()->or(null)->value(),
    'minlength' => $field->min_length()->or(null)->value(),
    'maxlength' => $field->max_length()->or(null)->value(),
    'pattern' => $field->pattern()->or(null)->value(),
  ];

  return $attributes;
}
