<template>
  <k-date-field
    class="arnoson-forms-preview"
    :class="{ required }"
    :time="false"
    :placeholder="content.placeholder"
    :label="label"
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
  }
}
</script>
