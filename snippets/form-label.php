<label for="<?= $id ?>">
  <?= $label ?>
  <?php if ($required): ?>
  <span aria-hidden="true">*</span>
  <?php endif; ?>
</label>