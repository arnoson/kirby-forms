<template>
  <k-button variant="filled" icon="download" @click="download()">
    {{ label }}
  </k-button>
</template>

<script>
export default {
  props: {
    formId: String,
    entryId: String,
    formData: Object,
    label: String,
  },
  methods: {
    download() {
      const path = this.entryId
        ? `kirby-forms/export/${this.formId}/${this.entryId}`
        : `kirby-forms/export/${this.formId}`
      window.location.pathname = path
    },
  },
}
</script>
