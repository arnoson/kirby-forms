<template>
  <k-select-field
    class="arnoson-forms-preview"
    :class="{ required }"
    :label="label"
    :options="options"
    :placeholder="content.placeholder"
    :value="content.default"
    :empty="content.empty"
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
