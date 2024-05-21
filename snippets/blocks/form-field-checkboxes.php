<?php
/** @var Uniform\Form $form */
use Kirby\Toolkit\Str;

$name = $block->name()->value();
$values = Str::split($form->old($name, null) ?? $block->default()->value());
?>

<fieldset>
  <?php snippet('form-legend', [
    'label' => $label,
    // Html doesn't allow required on a group of checkboxes.
    'required' => false,
  ]); ?>
  <?php foreach ($block->options()->toStructure() as $option): ?>
  <?php
  $value = $option->value();
  $optionId = "$id/$value";
  $label = $option->text()->isEmpty() ? $value : $option->text();
  $attributes = [
    'name' => $block->name() . '[]',
    'id' => $optionId,
    'value' => $value,
    'checked' => in_array($value, $values) ? true : null,
  ];
  ?>
  <div>
    <input type="checkbox" <?= attr($attributes) ?> />
    <label for="<?= $optionId ?>"><?= $label ?></label>
  </div>
  <?php endforeach; ?>
</fieldset>
