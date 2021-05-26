<?php $attributes = [
  'name' => $block->name(),
  'id' => $id,
  'required' => $block->required()->toBool()
]; ?>

<input type="checkbox" <?= attr($attributes) ?> />
