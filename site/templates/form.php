<h1>Form</h1>

<style>
.form-field-invalid {
  border: 1px solid red;
}

.form-row {
  display: grid;
  gap: 1em;
  grid-template-columns: repeat(6, 1fr);
}

.form-column {
  grid-column: span var(--span);
}

.form-field {
  display: flex;
  flex-direction: column;
}

.form-field {
  margin-bottom: 1em;
}

.form-field-required label::after {
  content: ' *';
  color: red;
}

.uniform__potty {
  position: absolute;
  left: -9999px;
}
</style>

<?php snippet('form'); ?>