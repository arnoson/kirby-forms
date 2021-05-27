<?php
$formPage ??= $page;
$formId = $form->slug();
?>

<form action="<?= $formPage->url() ?>" method="POST">
  <?php foreach ($formPage->fields()->toLayouts() as $layout): ?>
  <section class="form-row">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="form-column" style="--span:<?= $column->span() ?>">
      <?php foreach ($column->blocks() as $block): ?>
      <?php
      $name = $block->name();
      $label = $block->label()->isNotEmpty() ? $block->label() : $name;
      $id = "$formId/$name";
      ?>
      <div class="form-field">
        <?php snippet('blocks/' . $block->type(), [
          'block' => $block,
          'id' => $id,
          'label' => $label,
        ]); ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </section>
  <?php endforeach; ?>
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit">Submit</button>
</form>