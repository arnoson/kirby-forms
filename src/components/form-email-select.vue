<template>
  <k-field v-bind="$props" :input="id" class="k-select-field">
    <k-input
      v-bind="$props"
      :options="emailFieldOptions"
      ref="input"
      type="select"
      v-on="$listeners"
    />
  </k-field>
</template>

<script>
export default {
  extends: 'k-select-field',
  props: ['formData'],

  computed: {
    emailFieldOptions() {
      const fields = []
      for (const layout of this.formData.form_fields) {
        for (const column of layout.columns) {
          for (const { type, content } of column.blocks) {
            if (type === 'form-field-email') {
              fields.push({ value: content.name, text: content.label })
            }
          }
        }
      }
      return fields
    },
  },
}
</script>
