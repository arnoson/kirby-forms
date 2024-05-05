<fieldset>
  <?php snippet('form-legend', [
    'label' => $label,
    'required' => $block->required()->toBool(),
  ]); ?>
  <?php foreach ($block->options()->toStructure() as $option): ?>
  <?php
  $value = $option->value();
  $optionId = "$id/$value";
  $label = $option->text()->isEmpty() ? $value : $option->text();
  $attributes = [
    'name' => $block->name(),
    'id' => $optionId,
    'value' => $value,
    'required' => $block->required()->toBool() ? true : null,
    'checked' => $value == $block->default()->value() ? true : null,
  ];
  ?>
  <div>
    <input type="radio" <?= attr($attributes) ?> />
    <label for="<?= $optionId ?>"><?= $label ?></label>
  </div>
  <?php endforeach; ?>
</fieldset>
