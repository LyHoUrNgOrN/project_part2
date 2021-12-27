<template>
  <nav>
    <v-toolbar color="#44C7F5">
      <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon @click="showSideBar"> </v-app-bar-nav-icon>
      </span>
      <v-toolbar-title class="avatar">
        <router-link to="/" tag="span" style="cursor: pointer" v-if="showUser">
          <v-img
            class="image"
            src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
          ></v-img>
        </router-link>
      </v-toolbar-title>
      <v-toolbar-items class="btn" >
        <v-btn
          active-class="grey-5 white--text"
          class="profile white--text"
          text
          :to="{ path: '/profile-view' }"
        >
          My Profile
        </v-btn>

        <v-btn
          active-class="grey-5 white--text"
          text
          :to="{ path: '/company-view' }"
          class="company white--text"
          v-if="role != 'ERO'"
        >
          My Company
        </v-btn>

        <v-btn
          active-class="grey-5 white--text"
          text
          :to="{ path: '/explor-view' }"
          class="explor white--text"
          v-if="role == 'ERO' || role == 'ADMIN'"
        >
          Explor Alumni
        </v-btn>

        <v-btn
          active-class="grey-5 white--text"
          text
          :to="{ path: '/event-view' }"
          class="event white--text"
        >
          Event
        </v-btn>

        <v-btn
          active-class="grey-5 white--text"
          text
          v-if="role == 'ADMIN'"
          :to="{ path: '/manage-view' }"
          class="manage white--text"
        >
          Manage User
        </v-btn>
      </v-toolbar-items>

      <v-spacer></v-spacer>

      <v-btn
        active-class="grey-5 blue--text"
        text
        :to="{ path: '/signin' }"
        @click="signout"
        class="logout blue--text"
        >Sign Out</v-btn
      >
    </v-toolbar>
  </nav>
</template>

<script>
export default {
  props: {
    attrs: {
      type: Object,
      default: () => ({}),
    },
  },
  emits : ['log-out'],
  data() {
    return {
      sidebar: false,
      size: 0,
      role: "",
      showUser: true,
    };
  },
  methods: {
    showSideBar() {
      this.sidebar = !this.sidebar;
    },
    signout(){
      localStorage.clear();
      this.$emit('log-out',false)
      this.$router.push('/');
    }
  },
  mounted() {
    this.role = localStorage.getItem("role");
    if (window.innerWidth <= 600) {
      this.showUser = false;
    }
  },
};
</script>

<style lang="scss" scoped>


.logout{
    margin-left: 5px;
    border-radius: 20px;
    background: #fff;
    
}

.image{
  width: 55px;
  height: 55px;
}





.btn {
  margin-left: 18%;
}

.company,
.event,
.manage,
.explor {
  margin-left: 4%;
}

.logout {
  margin-left: 5px;
  border-radius: 20px;
  background: #fff;
}

.image {
  width: 55px;
  height: 55px;
}
</style>










