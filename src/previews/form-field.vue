<template>
  <component
    :is="component"
    class="arnoson-forms-preview"
    :style="`--kf-field-name: '${content.name}'`"
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
    content: '✶';
    font-size: var(--text-xs);
    color: var(--color-gray-500);
    margin-inline-start: var(--spacing-1);
  }

  .k-field-label::before {
    position: absolute;
    right: 0;
    content: var(--kf-field-name);
    color: var(--color-gray-500);
    font-weight: normal;
  }
}
</style>
