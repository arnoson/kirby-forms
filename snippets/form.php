<?php

use arnoson\KirbyForms\KirbyForms;

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
  'success' => $formPage->success_text()->value(),
]); ?>
<?php else: ?>

<form <?= attr([
  'action' => $page->url(),
  'method' => 'POST',
  'autocomplete' => option('arnoson.kirby-forms.autoComplete') ? 'on' : 'off',
  'novalidate' => option('arnoson.kirby-forms.clientValidation') ? null : true,
]) ?>>
  <?php snippet('form-fields', [
    'form' => $form,
    'formPage' => $formPage,
    'gridColumns' => option('arnoson.kirby-forms.gridColumns'),
    'showOldValues' => option('arnoson.kirby-forms.showOldValues'),
  ]); ?>
  <input type="hidden" name="form_name" value="<?= $formPage->title() ?>" />
  <?= csrf_field() ?>
  <?= honeypot_field() ?>
  <button type="submit" name="form_id" value="<?= $formId ?>">
    <?= $formPage->label_submit()->value() ?>
  </button>
</form>

<?php if ($hasErrors): ?>
<?php snippet('form-error', [
  'form' => $form,
  'error' => $formPage->error_invalidFields()->value(),
]); ?>
<?php endif; ?>

<?php endif; ?>
