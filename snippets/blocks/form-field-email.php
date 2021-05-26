<?php $attributes = [
  'name' => $block->name(),
  'id' => $id,
  'value' => $block->default()->isEmpty() ? null : $block->default(),
  'placeholder' => $block->placeholder()->isEmpty()
    ? null
    : $block->placeholder(),
  'required' => $block->required()->toBool(),
  'pattern'=> $block->pattern()->isEmpty()
    ? null
    // Strip slashes for use in html input.
    : substr($block->pattern()->value(), 1, -1)
]; ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input type="email" <?= attr($attributes) ?> />
