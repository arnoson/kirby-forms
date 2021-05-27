<?php $attributes = arnoson\KirbyForms\formFieldAttributes(
  $block,
  $form,
  $clientValidation,
  $showOldValues,
); ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input id="<?= $id ?>" type="date" <?= $attributes ?> />