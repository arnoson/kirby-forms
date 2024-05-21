<?php
/** @var Uniform\Form $form */
$name = $block->name()->value();
$fieldValue = $form->old($name, null) ?? $block->default()->value();
?>

<fieldset>
  <?php snippet('form-legend', [
    'label' => $label,
    'required' => $block->required()->toBool(),
  ]); ?>
  <?php foreach ($block->options()->toStructure() as $option): ?>
  <?php
  $optionValue = $option->value();
  $optionId = "$id/$optionValue";
  $label = $option->text()->isEmpty() ? $optionValue : $option->text();
  $attributes = [
    'name' => $block->name(),
    'id' => $optionId,
    'value' => $optionValue,
    'required' => $block->required()->toBool() ? true : null,
    'checked' => $optionValue == $fieldValue ? true : null,
  ];
  ?>
  <div>
    <input type="radio" <?= attr($attributes) ?> />
    <label for="<?= $optionId ?>"><?= $label ?></label>
  </div>
  <?php endforeach; ?>
</fieldset>
