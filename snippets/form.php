<?php

use arnoson\KirbyForms\KirbyForms;
use function arnoson\KirbyForms\formOption;

$formPage ??= $page;
$formId = KirbyForms::getFormId($formPage);
$submitSuccessful = $formId === flash('kirby-forms.success_form_id');
$submitLabel = formOption($formPage, 'label.submit')->value();

$form = new Uniform\Form(kirbyForms()->formRules($formPage), $formPage->id());
// There might be multiple forms rendered on the page, so we only process the
// form if the `form_id` is matching.
if ($kirby->request()->is('POST') && get('form_id') === $formId) {
  kirbyForms()->processRequest($formPage, $form);
}
?>

<?php if ($submitSuccessful): ?>
<?php if ($success = formOption($formPage, 'success.text')): ?>
<?php snippet('form-success', ['success' => $success]); ?>
<?php endif; ?>
<?php else: ?>
<form <?= attr([
  'action' => $page->url(),
  'method' => 'POST',
  'autocomplete' => formOption($formPage, 'autoComplete')->toBool()
    ? 'on'
    : 'off',
]) ?>>
  <?php snippet('form-fields', [
    'form' => $form,
    'formPage' => $formPage,
    'gridColumns' => formOption($formPage, 'gridColumns')->value(),
    'clientValidation' => formOption($formPage, 'clientValidation')->toBool(),
    'showOldValues' => formOption($formPage, 'showOldValues')->toBool(),
  ]); ?>
  <input type="hidden" name="form_name" value="<?= $formPage->title() ?>" />
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit" name="form_id" value="<?= $formId ?>"><?= $submitLabel ?></button>
</form>
<?php if ($error = formOption($formPage, 'error.invalidFields')): ?>
<?php snippet('form-error', ['form' => $form, 'error' => $error]); ?>
<?php endif; ?>
<?php endif; ?>
