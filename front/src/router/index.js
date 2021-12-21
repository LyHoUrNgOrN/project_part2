import Vue from 'vue'
import VueRouter from 'vue-router'
import signin from '@/components/authentication/SignIn.vue'
import signupone from '@/components/authentication/SignUpOne.vue'
import signuptwo from '@/components/authentication/SignUpTwo.vue'
import signupthree from '@/components/authentication/SignUpThree.vue'
import base_form from '@/components/ui/base-form.vue'
Vue.use(VueRouter)

const routes = [
  {path: '/', component: base_form},
  {path: '/signin', component: signin},
  {path: '/signupone', component: signupone},
  {path: '/signuptwo', component: signuptwo},
  {path: '/signupthree', component: signupthree},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
