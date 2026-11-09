import "@/scss/stisla.scss";

import { Ziggy } from "@/scripts/utils/ziggy";
import ZiggyVue from "@/scripts/utils/ziggy/ZiggyVue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { Config } from "ziggy-js";
import Baskito from "@timedoor/baskito-ui";
import { router } from '@inertiajs/vue3'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
  title: (title) => title ? `${title} - ${appName}` : appName,
  resolve: (name) => 
    resolvePageComponent(
      `../views/pages/${name.replace(/\./g, "/")}.vue`,
      import.meta.glob("../views/pages/**/*.vue"),
    ),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy as Config)
      .use(Baskito, { router })
      .mount(el)
  },
})
