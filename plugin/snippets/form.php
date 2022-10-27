<?php

use arnoson\KirbyForms\KirbyForms;

$formPage ??= $page;
$formId = KirbyForms::getFormId($formPage);
$submitSuccessful = $formId === flash('kirby-forms.success_form_id');

$clientValidation ??= option('arnoson.kirby-forms.clientValidation');
$showOldValues ??= true;
$submit ??= $formPage->form_submit_label();
$success ??= $formPage->form_success_message();
$error ??= true;
$gridColumns ??= option('arnoson.kirby-forms.gridColumns');
$autoComplete ??= option('arnoson.kirby-forms.autoComplete');

$form = new Uniform\Form(kirbyForms()->formRules($formPage), $formPage->id());
// There might be multiple forms rendered on the page, so we only process the
// form if the `form_id` is matching.
if ($kirby->request()->is('POST') && get('form_id') === $formId) {
  kirbyForms()->processRequest($formPage, $form);
}
?>

<?php if ($submitSuccessful): ?>
<?php if ($success): ?>
<?php snippet('form-success', ['success' => $success]); ?>
<?php endif; ?>
<?php else: ?>
<form <?= attr([
  'action' => $page->url(),
  'method' => 'POST',
  'autocomplete' => $autoComplete ? 'on' : 'off',
]) ?>>
  <?php snippet('form-fields', [
    'form' => $form,
    'formPage' => $formPage,
    'gridColumns' => $gridColumns,
    'clientValidation' => $clientValidation,
    'showOldValues' => $showOldValues,
  ]); ?>
  <input type="hidden" name="form_name" value="<?= $formPage->title() ?>" />
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit" name="form_id" value="<?= KirbyForms::getFormId(
    $formPage,
  ) ?>"><?= $submit ?></button>
</form>
<?php if ($error): ?>
<?php snippet('form-error', ['form' => $form, 'error' => $error]); ?>
<?php endif; ?>
<?php endif; ?>