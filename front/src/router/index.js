import Vue from 'vue'
import VueRouter from 'vue-router'

// ~~~~~~~~~~~~~~~~~~~~~~~|-IMPORT USER-|~~~~~~~~~~~~~~~~~~~~~~~ //
import MyProfile from '@/components/views/MyProfile.vue'
// ~~~~~~~~~~~~~~~~~~~~~|-IMPORT STUDENT-|~~~~~~~~~~~~~~~~~~~~~ //
import MyCompany from '@/components/views/MyCompany.vue'
// ~~~~~~~~~~~~~~~~~~~|-IMPORT PERMISSIION-|~~~~~~~~~~~~~~~~~~~~ /

Vue.use(VueRouter)

const routes = [{
    path: '/profile-view',
    component: MyProfile
  },
  {
    path: '/company-view',
    component: MyCompany
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router