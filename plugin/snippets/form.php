<?php
$formPage ??= $page;
$submitWasSuccessful = (params()['submit'] ?? null) == 'success';

$clientValidation ??= option('arnoson.kirby-forms.clientValidation');
$showOldValues ??= true;
$submit ??= $formPage->form_submit_label();
$success ??= $formPage->form_success_message();
$error ??= true;
$gridColumns ??= option('arnoson.kirby-forms.gridColumns');
$autoComplete ??= option('arnoson.kirby-forms.autoComplete');
?>

<?php if ($submitWasSuccessful): ?>
<?php if ($success): ?>
<?php snippet('form-success', ['success' => $success]); ?>
<?php endif; ?>
<?php else: ?>
<form <?= attr([
  'action' => $formPage->url(),
  'method' => 'POST',
  'autocomplete' => $autoComplete ? 'on' : 'off',
]) ?>>
  <?php snippet('form-fields', [
    'formPage' => $page,
    'gridColumns' => $gridColumns,
    'clientValidation' => $clientValidation,
    'showOldValues' => $showOldValues,
  ]); ?>
  <input type="hidden" name="form_name" value="<?= $formPage->title() ?>" />
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit"><?= $submit ?></button>
</form>
<?php if ($error): ?>
<?php snippet('form-error', ['form' => $form, 'error' => $error]); ?>
<?php endif; ?>
<?php endif; ?>