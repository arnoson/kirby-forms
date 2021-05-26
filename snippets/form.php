<?php
$formId = $form->slug();
?>
<form action="<?= $form->url() ?>" method="POST">
  <input type="hidden" name="__formId" value="<?= $formId ?>">
  <input type="hidden" name="__pageId" value="<?= $page->id() ?>">
  <?php foreach ($form->fields()->toLayouts() as $layout): ?>
  <section class="form-row">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="form-column" style="--span:<?= $column->span() ?>">
      <?php foreach ($column->blocks() as $block): ?>
      <?php
        $name = $block->name();
        $label = $block->label()->isNotEmpty() ? $block->label() : $name;
        $id = "$formId/$name";
      ?>
      <label for="<?= $id ?>"><?= $label ?></label>
      <?php snippet('blocks/' . $block->type(), [
        'block' => $block,
        'id' => $id
      ]) ?>
      <?php endforeach ?>
    </div>
    <?php endforeach ?>
  </section>
  <?php endforeach ?>
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit">Submit</button>
</form>
