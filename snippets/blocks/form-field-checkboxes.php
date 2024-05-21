<?php
/** @var Uniform\Form $form */
use Kirby\Toolkit\Str;

$name = $block->name()->value();
$fieldValue = Str::split($form->old($name, null) ?? $block->default()->value());
?>

<fieldset>
  <?php snippet('form-legend', [
    'label' => $label,
    // Html doesn't allow required on a group of checkboxes.
    'required' => false,
  ]); ?>
  <?php foreach ($block->options()->toStructure() as $option): ?>
  <?php
  $optionValue = $option->value();
  $optionId = "$id/$optionValue";
  $label = $option->text()->isEmpty() ? $optionValue : $option->text();
  $attributes = [
    'name' => $block->name() . '[]',
    'id' => $optionId,
    'value' => $optionValue,
    'checked' => in_array($optionValue, $fieldValue) ? true : null,
  ];
  ?>
  <div>
    <input type="checkbox" <?= attr($attributes) ?> />
    <label for="<?= $optionId ?>"><?= $label ?></label>
  </div>
  <?php endforeach; ?>
</fieldset>
