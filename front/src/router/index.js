import Vue from 'vue'
import VueRouter from 'vue-router'
import signin from '@/components/authentication/SignIn.vue'
import signupone from '@/components/authentication/SignUpOne.vue'
Vue.use(VueRouter)

const routes = [
  {path: '/signin', component: signin},
  {path: '/signupone', component: signupone},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
