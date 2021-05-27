import previews from './previews/*.vue'
import { toDashCase } from './utils'

const blocks = Object.fromEntries(
  Object.entries(previews).map(([key, value]) => [
    toDashCase(key),
    value.default
  ])
)

panel.plugin('arnoson/kirby-forms', { blocks })
