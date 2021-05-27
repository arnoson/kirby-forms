<h1>Form</h1>

<style>
[data-invalid] {
  border: 1px solid red;
}
</style>

<?php snippet('form', [
  'clientValidation' => false,
  'error' => false,
  'success' => 'Yey!',
  'submit' => 'Okay',
]); ?>