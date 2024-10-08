<template>
  <k-field
    v-bind="$props"
    :input="_uid"
    :help="preview"
    class="k-slug-field kf-field-identifier"
  >
    <template v-if="wizard && wizard.text" #options>
      <k-button :text="$t(wizard.text)" icon="wand" @click="onWizard" />
    </template>

    <k-input
      v-bind="$props"
      :id="_uid"
      ref="input"
      :value="slug"
      theme="field"
      type="form-identifier"
      v-on="$listeners"
    />
  </k-field>
</template>

<script>
export default {
  extends: 'k-slug-field',

  computed: {
    wizardText() {
      const { text } = this.wizard ?? {}
      return text.includes('.') ? this.$t(text) : text
    },
  },
}
</script>

<style>
.kf-field-identifier {
  button {
    /* The wizard buttons takes to much space and breaks the field layout. Not
    sure why this is happening. */
    height: auto;
  }
}
</style>
