import './bootstrap';
import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/vue2'
import vuetify from './plugins/vuetify'
import DefaultLayout from "./Layouts/default.vue"
import store from './store/index'
import components from "./components";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";


createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout === undefined ?  DefaultLayout : page.default.layout
        return page
    },
    setup({ el, App, props, plugin }) {
        Vue.use(plugin)
        Vue.use(Toast)
        new Vue({
            render: h => h(App, props),
            vuetify,
            store,
            components
        }).$mount(el)
    },
})
