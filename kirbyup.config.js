import { defineConfig } from 'kirbyup/config'

export default defineConfig({
  extendViteConfig: {
    publicDir: false,
    server: { cors: { origin: 'https://kirby-forms.ddev.site' } },
  },
})
