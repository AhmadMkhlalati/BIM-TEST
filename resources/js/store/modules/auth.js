const state = () => ({
    user: {
        email: '',
        password: '',
        name:'',

    },
    isLoad: true
});

const actions = {
    async login({ dispatch, commit }, info) {
        commit("SET_ISLOAD", false)
        await axios
            .post(`${info.api}`, info.form).then(res=>{
                    this._vm.$toast.success("The login process has been completed successfully.");
                    commit("SET_ISLOAD", true)
                 window.location.href = "/transaction"

            })
            .catch(err => {
                this._vm.$toast.error("Incorrect email or password");
                commit("SET_ISLOAD", true)
            })

    },
     logout({ dispatch, commit }) {

                commit('SET_USER', {})
                 window.location.href = "/login"
                this._vm.$toast.success("The logout process has been completed successfully.");

            },
    initUser({ commit }, value) {
        commit('SET_INIT_USER', value)
    },
}

const getters = {
    getUser: state => {
        return state.user
    },
    getIsLoad: state => {
        return state.isLoad
    },
}

const mutations = {
    SET_INIT_USER(state, payload) {
        state.user = payload
    },
    SET_USER(state, payload) {
        state.user = payload
    },
    SET_ISLOAD(state, payload) {
        state.isLoad = payload
    },
}


export default {
    state,
    getters,
    mutations,
    actions
}
