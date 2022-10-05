import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store';
import HomePage from '../views/Home.vue'
import auth from './modules/auth'
import projects from './modules/projects'

Vue.use(VueRouter)

let routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage
  }
]
routes = routes.concat(auth, projects)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (store.getters.isAuthenticated) {
      next()
      return
    }
    next('/login')
  } else {
    next()
  }
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.guest)) {
    if (store.getters.isAuthenticated) {
      next("/");
      return;
    }
    next();
  } else {
    next();
  }
});

export default router
