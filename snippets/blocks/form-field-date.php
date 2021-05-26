<?php $attributes = [
  'name' => $block->name(),
  'id' => $id,
  'value' => $block->default()->isEmpty() ? null : $block->default(),
  'required' => $block->required()->toBool()
]; ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input type="date" <?= attr($attributes) ?> />
