import axios from "axios";
const state = () => ({
    form: {},
    errors:{},
    item: {},
    items: {},
    loadingForm:true,
    loadingItem:true
});
const actions = {
    async sendForm({ dispatch, commit }, info) {
        commit('SET_LOADING', true)
        await axios
            .post(`${ !info.isNew ?  info.api.edit + info.id : info.api.create}`, info.form)
            .then(res => {
               // let resultData = res.data.data;
                dispatch('fetchTableData', info)

                this._vm.$toast.success(res.data.message ? res.data.message : "operation accomplished successfully");

            })
            .catch(err => {
                dispatch('fetchTableData', info)
                this._vm.$toast.error( err.response.data.message ? err.response.data.message:"The operation failed"
                );

            })

    },

    async fetchForm({ commit }, api) {
        commit('SET_LOADING', true)
        await axios
            .get(`${ api}`)
            .then(res => {
                let resultData = res.data.data;
                if(Array.isArray(resultData)){
                    commit("SET_FORM",resultData[0])
                }else{
                    commit("SET_FORM",resultData)
                }
                commit('SET_LOADING', false)

            })
            .catch(err => {
                commit('SET_LOADING', false)
            })

    },
    async fetchItem({ commit }, api) {
        commit('SET_LOADING_ITEM', true)
        await axios
            .get(`${ api}`)
            .then(res => {
                let resultData = res.data.data;
                if(Array.isArray(resultData)){
                    commit("SET_ITEM",resultData[0])
                }else{
                    commit("SET_ITEM",resultData)
                }
                commit('SET_LOADING_ITEM', false)
            })
            .catch(err => {
                commit('SET_LOADING_ITEM', false)
            })

    },
    async fetchItems({ commit }, api) {
        commit('SET_LOADING_ITEMS', true)
        await axios
            .get(`${ api}`)
            .then(res => {
                let resultData = res.data.data;

                if(Array.isArray(resultData)){
                    commit("SET_ITEMS",resultData)
                }else{
                    commit("SET_ITEMS",resultData)
                }
                commit('SET_LOADING_ITEMS', false)
            })
            .catch(err => {
                commit('SET_LOADING_ITEMS', false)
            })
    },

    setForm({ commit }, form) {
        console.log(form)
        commit('SET_FORM', form)
        commit('SET_ERROR', form)
    },
    initForm({ commit }, init_form) {
        commit('SET_INIT_FORM', init_form)
    },

}

const getters = {
    getForm: state => {
        return state.form
    },
    getError: state => {
        return state.errors
    },
    getItem: state => {
        return state.item
    },
    getItems: state => {
        return state.items
    },
    getLoadingForm: state => {
        return state.loadingForm
    },
    getLoadingItem: state => {
        return state.loadingItem
    },
}

const mutations = {
    SET_TABLE_DATA(state, payload) {
        state.tableData = payload
    },
    SET_FORM(state, payload) {
        let temp_form = state.form
        let t
        for (t in temp_form) {
            state.form[t] = payload[t]
        }
    },
    SET_ERROR(state, payload) {
        let temp_form = state.form
        let t
        for (t in temp_form) {
            state.errors[t] = null
        }
    },
    SET_ITEM(state, payload) {
        state.item = payload
    },
    SET_ITEMS(state, payload) {
        state.items = payload
    },
    SET_INIT_FORM(state, payload) {
        state.form = payload
    },
    SET_LOADING(state, payload) {
        state.loadingForm = payload
    },
    SET_LOADING_ITEM(state, payload) {
        state.loadingItem = payload
    },
    SET_LOADING_ITEMS(state, payload) {
        state.loadingItems = payload
    },

}


export default {
    state,
    getters,
    mutations,
    actions
}
