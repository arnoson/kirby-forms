<?php $attributes = arnoson\KirbyForms\formFieldAttributes(
  $id,
  $block,
  $form,
  $clientValidation,
  $showOldValues
); ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input id="<?= $id ?>" type="number" <?= attr($attributes) ?> />