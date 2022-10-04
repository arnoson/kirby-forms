import { kirbyup } from 'kirbyup/plugin'

window.panel.plugin('arnoson/kirby-forms', {
  blocks: kirbyup.import('./previews/*.vue'),
})
