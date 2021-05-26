<?php $attributes = [
  'name' => $block->name(),
  'id' => $id,
  'required' => $block->required()->toBool(),
  'pattern'=> $block->pattern()->isEmpty()
    ? null
    // Strip slashes for use in html input.
    : substr($block->pattern()->value(), 1, -1)
]; ?>

<input type="email" <?= attr($attributes) ?> />
