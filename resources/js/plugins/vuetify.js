import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import config from '../config'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader


Vue.use(Vuetify)


export default new Vuetify({
    theme: {
        themes: {
            light: config.light,

        }
    },
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
        // reusable custom icon


});
