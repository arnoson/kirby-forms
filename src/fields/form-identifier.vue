<template>
  <k-field v-bind="$props" :input="_uid" :help="preview" class="k-slug-field">
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
