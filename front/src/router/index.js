import Vue from "vue";
import VueRouter from "vue-router";

import signin from "@/components/authentication/SignIn.vue";
import signupone from "@/components/authentication/SignUpOne.vue";
import signuptwo from "@/components/authentication/SignUpTwo.vue";
import signupthree from "@/components/authentication/SignUpThree.vue";

import MyProfile from '@/components/views/MyProfile.vue'
import MyCompany from '@/components/views/MyCompany.vue'
import ExplorAlumni from '@/components/views/Alumni_Company.vue'
import Event from '@/components/views/Event.vue'
import ManageUser from '@/components/views/ManageUser.vue'
Vue.use(VueRouter)

const routes = [{
      path: "/",
      component: signin
    },
    {
      path: "/signin",
      component: signin
    },
    {
      path: "/signupone",
      component: signupone
    },
    {
      path: "/signuptwo",
      component: signuptwo
    },
    {
      path: "/signupthree",
      component: signupthree
    },


    {
      path: '/profileView',
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
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router