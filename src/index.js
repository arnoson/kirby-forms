import { kirbyup } from 'kirbyup/plugin'
import FormIdentifierField from './fields/form-identifier.vue'
import FormIdentifierInput from './components/form-identifier-input.vue'
import ExportFormEntries from './components/export-form-entries.vue'

window.panel.plugin('arnoson/kirby-forms', {
  blocks: kirbyup.import('./previews/*.vue'),
  fields: {
    'form-identifier': FormIdentifierField,
    'export-form-entries': ExportFormEntries,
  },
  components: { 'k-form-identifier-input': FormIdentifierInput },
})
