<template>
  <component
    :is="component"
    class="arnoson-forms-preview"
    :time="false"
    :class="{ required }"
    :placeholder="content.placeholder"
    :label="label"
    :value="defaultValue"
    :buttons="buttons"
    :options="options"
    :empty="empty"
  />
</template>

<script>
export default {
  props: ['content'],

  computed: {
    required() {
      return this.content.required
    },

    label() {
      return this.content.label || this.content.name
    },

    defaultValue() {
      return this.content.default
    },

    empty() {
      return this.content.empty
    },

    options() {
      return this.content.options?.map(({ value, text }) => ({
        value,
        text: text || value,
      }))
    },
  },
}
</script>

<style lang="scss">
.arnoson-forms-preview {
  pointer-events: none;

  &.required .k-field-label::after {
    content: '*';
    padding-left: 0.25rem;
    color: var(--color-gray-500);
  }
}
</style>
