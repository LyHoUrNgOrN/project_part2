<template>
  <v-app>
    
    <Menubar v-if="showNavigation" @log-out="signOut"/>
    <v-main>
      <v-container fluid>
        <router-view @login="Login"></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
// import Sidebar from "@/components/nav/Sidebar.vue";
import Menubar from './components/nav/Menubar.vue';
export default {
  components: {

    Menubar,
  },
  data() {
    return {
      role: "",
      showNavigation: false,
    };
  },
  methods: {
    signOut(isSignOut){
      this.showNavigation = isSignOut;
    },
    Login(isSignIn){
      this.showNavigation = isSignIn;
    }
  },
  mounted() {
    this.role = localStorage.getItem("role");
    if(localStorage.getItem('role') != null || this.$router === '/profile-view') {
      this.showNavigation = true;
      this.$router.push('/profile-view')
    }
  },
};
</script>

 
<style>
#app {
  background: #f1f2f7;
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