<?php $attributes = arnoson\KirbyForms\formFieldAttributes(
  $id,
  $block,
  $form,
  $clientValidation,
  $showOldValues,
); ?>

<label for="<?= $id ?>"><?= $label ?></label>
<input id="<?= $id ?>" <?= e($clientValidation, 'type="email"') ?> <?= attr(
   $attributes,
 ) ?> />