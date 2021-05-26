<template>
  <k-radio-field
    class="arnoson-forms-preview"
    :class="{ required }"
    :label="label"
    :options="options"
    :value="content.default"
  />
</template>

<script>
export default {
  computed: {
    required() {
      return this.content.required
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
