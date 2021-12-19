import Vue from 'vue'
import VueRouter from 'vue-router'
import signin from "./../components/views/Signin.vue";

Vue.use(VueRouter)

const routes = [
  { path: "/", component: signin },
  // { path: "/home", component: signin },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
