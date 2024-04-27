<template>
  <k-field
    v-bind="$props"
    :input="_uid"
    :help="preview"
    class="k-slug-field kf-field-identifier"
  >
    <template v-if="wizard && wizard.text" #options>
      <k-button :text="wizard.text" icon="wand" @click="onWizard" />
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
