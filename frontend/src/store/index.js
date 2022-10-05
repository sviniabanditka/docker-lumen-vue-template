import Vuex from 'vuex';
import Vue from 'vue';
import createPersistedState from "vuex-persistedstate";
import auth from './modules/auth';
import projects from './modules/projects';

// load vuex
Vue.use(Vuex);
// create store
export default new Vuex.Store({
  modules: {
    auth,
    projects
  },
  plugins: [createPersistedState()]
});