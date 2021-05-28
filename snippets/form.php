<?php
$formPage ??= $page;
$submitWasSuccessful = (params()['submit'] ?? null) == 'success';

$clientValidation ??= true;
$showOldValues ??= true;
$submit ??= 'Submit';
$success ??= null;
$error ??= true;
$gridColumns ??= 6;
?>

<?php if ($submitWasSuccessful): ?>
<?php if ($success): ?>
<?php snippet('form-success', ['success' => $success]); ?>
<?php endif; ?>
<?php else: ?>
<form action="<?= $formPage->url() ?>" method="POST">
  <?php snippet('form-fields', [
    'formPage' => $page,
    'gridColumns' => $gridColumns,
    'clientValidation' => $clientValidation,
    'showOldValues' => $showOldValues,
  ]); ?>
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit"><?= $submit ?></button>
</form>
<?php if ($error): ?>
<?php snippet('form-error', ['form' => $form, 'error' => $error]); ?>
<?php endif; ?>
<?php endif; ?>