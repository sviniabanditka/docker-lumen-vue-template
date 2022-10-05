import axios from 'axios';
const state = {
    user: null,
    clientToken: null,
    userToken: null,
};
const getters = {
    isAuthenticated: state => !!state.userToken,
    stateUser: state => state.user,
    stateClientToken: state => state.clientToken,
    stateUserToken: state => state.userToken,
};
const actions = {
    async initAuth({commit}) {
        let response = await axios.post('auth/token', {
            grant_type: 'client_credentials',
            scope: '*',
            client_id: process.env.VUE_APP_BASE_API_ID,
            client_secret: process.env.VUE_APP_BASE_API_SECRET,
        })
        if (response.data.access_token) {
            await commit('setClientToken', response.data.access_token)
        }
    },
    async register({commit}, form) {
        let response = await axios.post('auth/register', {
            username: form.username,
            email: form.email,
            password: form.password
        })
        if (response.data.success) {
            await commit('setUser', response.data.data.user)
            await commit('setUserToken', response.data.data.token)
        }
    },
    async login({commit}, user) {
        let response = await axios.post('auth/login', {
            email: user.email,
            password: user.password
        })
        if (response.data.success) {
            await commit('setUser', response.data.data.user)
            await commit('setUserToken', response.data.data.token)
        }
    },
    async logout({commit}){
        commit('logout')
        commit('setProjects', null)
    }
};
const mutations = {
    setUser(state, user){
        state.user = user
    },
    setClientToken(state, token){
        state.clientToken = token
        axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
    },
    setUserToken(state, token){
        state.userToken = token
        axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
    },
    logout(state){
        state.user = null
        state.userToken = null
    },
};
export default {
  state,
  getters,
  actions,
  mutations
};