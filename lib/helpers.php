<?php

namespace arnoson\KirbyForms;

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
) {
  $name = $field->name()->value();

  $attributes = [
    'name' => $name,
    'value' => $showOldValues
      ? $form->old($name)
      : fieldNotEmpty($field->default()),
    'placeholder' => fieldNotEmpty($field->placeholder()),
    'data-invalid' => !!$form->error($name),
  ];

  if ($clientValidation) {
    $attributes = array_merge($attributes, [
      'required' => $field->required()->toBool(),
      'minlength' => fieldNotEmpty($field->min()),
      'maxlength' => fieldNotEmpty($field->max()),
      'pattern' => $field->pattern()->isEmpty()
        ? null
        : // Strip slashes for use in html input.
        substr($field->pattern(), 1, -1),
    ]);
  }

  return attr($attributes);
}