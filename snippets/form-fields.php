<?php $formSlug = $formPage->slug(); ?>

<?php foreach ($formPage->form_fields()->toLayouts() as $layout): ?>
<div class="form-row">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="form-column" style="--span:<?= $column->span($gridColumns) ?>">
    <?php foreach ($column->blocks() as $block): ?>
    <?php
    $name = $block->name()->value();
    $label = $block->label()->isNotEmpty() ? $block->label() : $name;
    $id = "$formSlug/field/$name";
    $type = $block->type();
    $fieldPrefix = 'form-field-';
    $shortType = str_replace($fieldPrefix, '', $type);
    $isField = str_starts_with($type, $fieldPrefix);
    ?>

    <?php if ($isField): ?>
    <div class="form-field" data-field-type="<?= $shortType ?>">
      <?php snippet("blocks/$type", [
        'form' => $form,
        'block' => $block,
        'id' => $id,
        'label' => $label,
      ]); ?>
      <?php if ($error = $form->error($name)[0] ?? null): ?>
      <small class="form-field-error" id="<?= $id ?>/error"><?= $error ?></small>
      <?php endif; ?>
    </div>
    <?php else: ?>
    <?= $block ?>
    <?php endif; ?>

    <?php endforeach; ?>
  </div>
  <?php endforeach; ?>
</div>
<?php endforeach; ?>
