import Vue from 'vue';
import Vuex from 'vuex';
import Table from './modules/table'
import Form from './modules/form'
import Auth from './modules/auth'


Vue.use(Vuex);

export default new Vuex.Store({

    namespace: true,
    state: {
        drawer: false
    },
    mutations: {
        toggleDrawer(state) {
            state.drawer = !state.drawer;
        }
    },
    actions: {
        TOGGLE_DRAWER({ commit }) {
            commit('toggleDrawer');
        }
    },
    getters: {
        DRAWER_STATE(state) {
            return state.drawer;
        }
    },
    modules: {
        Table,
        Form,
        Auth
    }
});
