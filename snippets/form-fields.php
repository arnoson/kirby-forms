<?php $formSlug = $formPage->slug(); ?>

<?php foreach ($formPage->form_fields()->toLayouts() as $layout): ?>
<section class="form-row">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="form-column" style="--span:<?= $column->span($gridColumns) ?>">
    <?php foreach ($column->blocks() as $block): ?>
    <?php
    $name = $block->name()->value();
    $label = $block->label()->isNotEmpty() ? $block->label() : $name;
    $id = "$formSlug/field/$name";
    ?>
    <div class="form-field<?= e(
      $block->required()->toBool(),
      ' form-field-required',
    ) ?>">
      <?php snippet('blocks/' . $block->type(), [
        'form' => $form,
        'block' => $block,
        'id' => $id,
        'label' => $label,
        'clientValidation' => $clientValidation,
        'showOldValues' => $showOldValues,
      ]); ?>
      <?php if ($error = $form->error($name)): ?>
      <div class="form-field-error" id="<?= $id ?>/error"><?= $error[0] ?></div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endforeach; ?>
</section>
<?php endforeach; ?>
