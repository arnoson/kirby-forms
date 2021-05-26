<template>
  <k-email-field
    class="arnoson-forms-preview"
    :class="{ required }"
    :value="content.default"
    :placeholder="content.placeholder"
    :label="label"
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
  }
}
</script>
