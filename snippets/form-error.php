<div class="form-error">
  <?php if (is_string($error)) {
    echo $error;
  } else {
    snippet('uniform/errors', ['form' => $form]);
  } ?>
</div>
