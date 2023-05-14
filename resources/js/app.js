import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import MainLayout from './Layouts/MainLayout.vue'
import {ZiggyVue} from 'ziggy'
import {InertiaProgress} from '@inertiajs/progress'
import '../css/app.css'

InertiaProgress.init({
    delay: 0,
    color: '#29d',
    includeCSS: true,
    showSpinner: true,
})

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue')

    //const page = await pages[`./Pages/${name}.vue`]()

    const pagePath = `./Pages/${name}.vue`

    if (!pages[pagePath]) {
      throw new Error(`Could not find page '${pagePath}'`)
    }

    const page = await pages[pagePath]()

    page.default.layout = page.default.layout || MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el)
  },
})
