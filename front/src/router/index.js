import Vue from 'vue'
import VueRouter from 'vue-router'
<<<<<<< HEAD
import signin from '@/components/authentication/SignIn.vue'
import signupone from '@/components/authentication/SignUpOne.vue'
Vue.use(VueRouter)

const routes = [
  {path: '/signin', component: signin},
  {path: '/signupone', component: signupone},
=======
import signin from "./../components/views/Signin.vue";

Vue.use(VueRouter)

const routes = [
  { path: "/", component: signin },
  // { path: "/home", component: signin },
>>>>>>> sign-in
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
