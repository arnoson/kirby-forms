<template>
  <k-button
    variant="filled"
    icon="download"
    :disabled="!formHasEntries"
    @click="download()"
  >
    Export
  </k-button>
</template>

<script>
export default {
  props: {
    formId: String,
    formData: Object,
  },
  computed: {
    formHasEntries() {
      return !!this.formData['form_entries'].length
    },
  },
  methods: {
    download() {
      window.location.pathname = `kirby-forms/export/${this.formId}`
    },
  },
}
</script>
