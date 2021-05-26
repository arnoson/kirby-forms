<?php $attributes = [
  'name' => $block->name(),
  'id' => $id,
  'required' => $block->required()->toBool(),
  'minlength' => $block->min()->isEmpty() ? null : $block->min()->value(),
  'maxlength' => $block->max()->isEmpty() ? null : $block->max()->value(),
  'pattern'=> $block->pattern()->isEmpty()
    ? null
    // Strip slashes for use in html input.
    : substr($block->pattern()->value(), 1, -1)
]; ?>

<input <?= attr($attributes) ?> />
