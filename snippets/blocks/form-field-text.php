<?php $attributes = [
  'name' => $block->name(),
  'id' => $id,
  'placeholder' => $block->placeholder()->isEmpty()
    ? null
    : $block->placeholder(),
  'value' => $block->default()->isEmpty() ? null : $block->default(),
  'required' => $block->required()->toBool(),
  'minlength' => $block->min()->isEmpty() ? null : $block->min(),
  'maxlength' => $block->max()->isEmpty() ? null : $block->max(),
  'pattern'=> $block->pattern()->isEmpty()
    ? null
    // Strip slashes for use in html input.
    : substr($block->pattern(), 1, -1)
]; ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input <?= attr($attributes) ?> />
