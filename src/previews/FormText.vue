<template>
  <k-text-field class="arnoson-forms-text" :label="label"/>
</template>

<script>
export default {
  mounted() {
    console.log(this.content)
  },

  computed: {
    label() {
      const label = this.content.label || this.content.name
      return label + (this.content.required ? ' *' : '')
    }
  }
}
</script>

<style>
.arnoson-forms-text > * {
  pointer-events: none;
}
</style>
