<?php
$attributes = [
  'name' => $block->name(),
  'id' => $id,
  'required' => $block->required()->toBool()
];
?>

<label for="<?= $id ?>"><?= $label ?></label>
<select <?= attr($attributes) ?>>
  <?php if (
    $block->empty()->toBool() || $block->default()->isEmpty()
  ): ?>
    <option value=""><?=
      $block->placeholder()->isEmpty() ? ' — ' : $block->placeholder()
    ?></option>
  <?php endif ?>
  <?php foreach($block->options()->toStructure() as $option): ?>
  <option <?= attr([
    'value' => $option->value(),
    'selected' => $option->value()->value() == $block->default()->value()
  ]) ?>><?=
    $option->text()->isEmpty() ? $option->value() : $option->text()
  ?></option>
  <?php endforeach ?>
</select>
