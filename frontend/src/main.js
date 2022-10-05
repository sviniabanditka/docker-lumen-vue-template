import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store';
import axios from 'axios';


//configure axios
axios.defaults.baseURL = process.env.VUE_APP_BASE_API_URL;
if (!store.getters.stateClientToken) {
  //generate client token
  store.dispatch('initAuth')
}
axios.defaults.headers.common = {
  'Authorization': `Bearer ${store.getters.stateUserToken ? store.getters.stateUserToken : store.getters.stateClientToken}`
}
axios.defaults.withCredentials = true
axios.interceptors.response.use(undefined, function (error) {
  if (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {
        originalRequest._retry = true;
        store.dispatch('initAuth')
        store.dispatch('logout')
        return router.push('/login')
    }
  }
  return Promise.reject(error);
})

//setup vue
Vue.config.productionTip = false
Vue.prototype.$store = store

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
