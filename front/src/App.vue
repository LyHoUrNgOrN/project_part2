<template>
  <v-app>
    <v-navigation-drawer app v-model="showNavigation" absolute temporary>
      <Sidebar />
    </v-navigation-drawer>

    <v-app-bar app color="#44C7F5">
      <div class="hidden-sm-and-up">
        <v-app-bar-nav-icon
          dark
          @click.prevent="showNavigation = !showNavigation"
        ></v-app-bar-nav-icon>
      </div>
      <ul>
        <img
          width="50"
          class=""
          src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
        />

        <div>
          <v-tabs dark class="border">
            <v-tab class="white--text active" :to="{ path: '/profile-view' }"
              >My profile</v-tab
            >
            <v-tab class="white--text active" :to="{ path: '/company-view' }"
            v-if="role == 'ALUMNI'"
              >Company</v-tab
            >
            <v-tab
              class="white--text active"
              :to="{ path: '/explor-view' }"
              v-if="role == 'ERO' || role == 'ADMIN'"
              >Explor Alumni</v-tab
            >
            <v-tab class="white--text active" :to="{ path: '/event-view' }"
              >Events</v-tab
            >
            <v-tab class="white--text active" v-if="role == 'ADMIN'"
          :to="{ path: '/manage-view' }"
              >Manage user</v-tab
            >
          </v-tabs>
        </div>

        <v-btn depressed color="white" class="rounded-lg pa-5 mt-2 cyan--text">
          Sign out
        </v-btn>
      </ul>
      <div class="img hidden-sm-and-up">
        <img
          width="45"
          src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
        />
      </div>
    </v-app-bar>
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import Sidebar from "@/components/nav/Sidebar.vue";
export default {
  components: {
    Sidebar,
  },
  data() {
    return {
      role: "",
      showNavigation: false,
    };
  },
  mounted() {
    this.role = localStorage.getItem("role");
  },
};
</script>

 
<style>
#app {
  background: #f1f2f7;
}
.active {
  background: #44c7f5;
}
ul {
  width: 100%;
  display: flex;
  justify-content: space-between;
}
@media (max-width: 600px) {
  ul {
    display: none;
  }
  .img {
    position: absolute;
    right: 0;
    margin: 8px 10px 0px 0px;
  }
}
</style>