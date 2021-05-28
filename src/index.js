import previews from './previews/*.vue'
import FormEntries from './fields/FormEntries.vue'
import { toDashCase } from './utils'

const blocks = Object.fromEntries(
  Object.entries(previews).map(([key, value]) => [
    toDashCase(key),
    value.default
  ])
)

console.log(FormEntries)

panel.plugin('arnoson/kirby-forms', {
  blocks,
  fields: { 'form-entries': FormEntries }
})
