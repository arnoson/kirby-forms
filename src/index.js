import { kirbyup } from 'kirbyup/plugin'
import FormEntries from './fields/form-entries.vue'

window.panel.plugin('arnoson/kirby-forms', {
  blocks: kirbyup.import('./previews/*.vue'),
  fields: { 'form-entries': FormEntries }
})
