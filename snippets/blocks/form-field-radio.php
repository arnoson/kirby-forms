<fieldset>
  <legend><?= $label ?></legend>
  <?php foreach ($block->options()->toStructure() as $option): ?>
  <?php
  $value = $option->value();
  $optionId = "$id/$value";
  $label = $option->text()->isEmpty() ? $value : $option->text();
  $attributes = [
    'name' => $block->name(),
    'id' => $optionId,
    'value' => $value,
    'checked' => $value == $block->default()->value() ? true : null,
  ];
  ?>
  <div>
    <input type="radio" <?= attr($attributes) ?> />
    <label for="<?= $optionId ?>"><?= $label ?></label>
  </div>
  <?php endforeach; ?>
</fieldset>
