<?php
// Using The `formFieldAttributes()` helper, will already provide our range
// input with all common attributes (min, max, step, aria, ...).
// See: https://github.com/arnoson/kirby-forms/blob/master/lib/helpers.php
$attributes = arnoson\KirbyForms\formFieldAttributes(
  $id,
  $block,
  $form,
  $clientValidation,
  $showOldValues,
);
?>

<label for="<?= $id ?>"><?= $label ?></label>
<input id="<?= $id ?>" type="range" <?= attr($attributes) ?> />