<?php $attributes = arnoson\KirbyForms\formFieldAttributes(
  $id,
  $block,
  $form,
  $showOldValues
); ?>

<?php snippet('form-label', [
  'id' => $id,
  'label' => $label,
  'required' => $block->required()->toBool(),
]); ?>
<input id="<?= $id ?>" type="url" <?= attr($attributes) ?> />