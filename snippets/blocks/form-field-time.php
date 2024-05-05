<?php $attributes = arnoson\KirbyForms\formFieldAttributes(
  $id,
  $block,
  $form,
  $showOldValues
); ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input id="<?= $id ?>" type="time" <?= attr($attributes) ?> />