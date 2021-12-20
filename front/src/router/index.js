import Vue from 'vue'
import VueRouter from 'vue-router'


import MyProfile from '@/components/views/MyProfile.vue'
import MyCompany from '@/components/views/MyCompany.vue'
import ExplorAlumni from '@/components/views/ExplorAlumni.vue'
import Event from '@/components/views/Event.vue'
import ManageUser from '@/components/views/ManageUser.vue'


Vue.use(VueRouter)

const routes = [{
    path: '/profile-view',
    component: MyProfile
  },
  {
    path: '/company-view',
    component: MyCompany
  },
  {
    path: '/explor-view',
    component: ExplorAlumni
  },
  {
    path: '/event-view',
    component: Event
  },
  {
    path: '/manage-view',
    component: ManageUser
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router