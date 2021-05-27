<?php
$formPage ??= $page;
$formId = $page->slug();
$clientValidation ??= true;
$showOldValues ??= true;
$submit ??= 'Submit';
$success ??= null;
$error ??= true;
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
          'form' => $form,
          'clientValidation' => $clientValidation,
          'showOldValues' => $showOldValues,
        ]); ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </section>
  <?php endforeach; ?>
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit"><?= $submit ?></button>
</form>

<?php if ($success && $form->success()): ?>
<div class="form-success"><?= $success ?></div>
<?php elseif ($error): ?>
<div class="form-error">
  <?php if (is_string($error)) {
    echo $error;
  } else {
    snippet('uniform/errors', ['form' => $form]);
  } ?>
</div>
<?php endif; ?>