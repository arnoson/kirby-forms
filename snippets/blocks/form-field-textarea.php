<?php
$attributes = arnoson\KirbyForms\formFieldAttributes(
  $id,
  $block,
  $form,
  $showOldValues
);

$value = $attributes['value'];
unset($attributes['value']);
?>

<label for="<?= $id ?>"><?= $label ?></label>
<textarea id="<?= $id ?>" <?= attr($attributes) ?>><?= $value ?></textarea>