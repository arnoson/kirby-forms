<?php

use arnoson\KirbyForms\KirbyForms;
use function arnoson\KirbyForms\formOption;

$formPage ??= $page;
$formId = KirbyForms::getFormId($formPage);
$form = new Uniform\Form(kirbyForms()->formRules($formPage), $formId);
$hasErrors = count($form->errors()) > 0;

// There might be multiple forms rendered on the page, so we only process the
// form if the form's id is matching.
if ($kirby->request()->is('POST') && get('form_id') === $formId) {
  kirbyForms()->processRequest($formPage, $form);
}
?>

<?php if ($form->success()): ?>
<?php snippet('form-success', [
  'success' => formOption($formPage, 'success.text'),
]); ?>
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
  <button type="submit" name="form_id" value="<?= $formId ?>">
    <?= formOption($formPage, 'label.submit')->value() ?>
  </button>
</form>

<?php if ($hasErrors): ?>
<?php snippet('form-error', [
  'form' => $form,
  'error' => formOption($formPage, 'error.invalidFields'),
]); ?>
<?php endif; ?>

<?php endif; ?>
