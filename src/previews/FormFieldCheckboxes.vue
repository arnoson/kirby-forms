<template>
  <k-checkboxes-field
    class="arnoson-forms-preview"
    :class="{ required }"
    :label="label"
    :options="options"
    :value="defaultValue"
  />
</template>

<script>
export default {
  computed: {
    required() {
      return this.content.required
    },

    defaultValue() {
      return this.content.default?.split(',').map(el => el.trim())
    },

    label() {
      return this.content.label || this.content.name
    },

    options() {
      return this.content.options.map(({ value, text }) => ({
        value,
        text: text || value
      }))
    }
  }
}
</script>
