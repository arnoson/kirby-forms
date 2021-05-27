<template>
  <k-textarea-field
    class="arnoson-forms-preview"
    :class="{ required }"
    :placeholder="content.placeholder"
    :label="label"
    :value="content.default"
    :buttons="false"
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
    }
  }
}
</script>
