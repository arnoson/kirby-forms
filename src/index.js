import { kirbyup } from 'kirbyup/plugin'
import FormIdentifierField from './fields/form-identifier.vue'
import FormIdentifierInput from './components/form-identifier-input.vue'

window.panel.plugin('arnoson/kirby-forms', {
  blocks: kirbyup.import('./previews/*.vue'),
  fields: { 'form-identifier': FormIdentifierField },
  components: { 'k-form-identifier-input': FormIdentifierInput },
})
