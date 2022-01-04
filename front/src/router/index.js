import Vue from "vue";
import VueRouter from "vue-router";

import signin from "@/components/authentication/SignIn.vue";
import signupone from "@/components/authentication/SignUpOne.vue";
import signuptwo from "@/components/authentication/SignUpTwo.vue";
import signupthree from "@/components/authentication/SignUpThree.vue";
import alumnicompany from "@/components/views/Alumni_Company.vue";

import MyProfile from '@/components/views/MyProfile.vue'
import Event from '@/components/views/Event.vue'
import ManageUser from '@/components/views/ManageUser.vue'
import Warning from '@/components/ui/Warning.vue'
import Explore_Alumni from '@/components/views/Explore_Alumni.vue'
import detail_alumni from '@/components/views/Alumni_detail.vue'
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
      path: "/company-view",
      component: alumnicompany
    },
    {
      path: '/profile-view',
      component: MyProfile
    },

    {
      path: '/event-view',
      component: Event
    },
    {
      path: '/manage-view',
      component: ManageUser
    },
    {
      path: '/explor-view',
      component: Explore_Alumni
    },
    {
      path: '/warning',
      component: Warning
    },
    {
      path: '/detail-alumni',
      component: detail_alumni,
    },


  ]

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router