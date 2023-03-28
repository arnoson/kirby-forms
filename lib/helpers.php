<?php

namespace arnoson\KirbyForms;

use Kirby\Cms\Page;

/**
 * Return the value of a field, or null if the field is empty.
 */
function fieldNotEmpty($field) {
  return $field->isEmpty() ? null : $field->value();
}

/**
 * Generate the html attributes for a form field.
 * @param Kirby\Cms\Block $field
 * @param Uniform\Form $form
 */
function formFieldAttributes(
  $field,
  $form,
  bool $clientValidation,
  bool $showOldValues
): array {
  $name = $field->name()->value();
  $oldValue = $form->old($name);
  $default = fieldNotEmpty($field->default());
  $value = $showOldValues && $oldValue ? $oldValue : $default;

  $attributes = [
    'name' => $name,
    'value' => $value,
    'placeholder' => fieldNotEmpty($field->placeholder()),
    'step' => fieldNotEmpty($field->step()),
    'class' => $form->error($name) ? 'form-field-invalid' : null,
  ];

  if ($clientValidation) {
    $attributes = array_merge($attributes, [
      'required' => $field->required()->toBool(),
      'min' => fieldNotEmpty($field->min()),
      'max' => fieldNotEmpty($field->max()),
      'minlength' => fieldNotEmpty($field->minLength()),
      'maxlength' => fieldNotEmpty($field->maxLength()),
      'pattern' => $field->pattern()->isEmpty()
        ? null
        : // Strip slashes for use in html input.
        substr($field->pattern(), 1, -1),
    ]);
  }

  return $attributes;
}
