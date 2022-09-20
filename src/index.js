import { kirbyup } from 'kirbyup/plugin'
import FormEntries from './fields/form-entries.vue'

// import previews from './previews/*.vue'
// import { toDashCase } from './utils'

// const blocks = Object.fromEntries(
//   Object.entries(previews).map(([key, value]) => [
//     toDashCase(key),
//     value.default
//   ])
// )

window.panel.plugin('arnoson/kirby-forms', {
  blocks: kirbyup.import('./previews/*.vue'),
  fields: { 'form-entries': FormEntries }
})
