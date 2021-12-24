<template>
  <v-app>
    <Navbar v-if="login" @log-out="logout"/>
    <v-main>
      <router-view @login="Login"/>
    </v-main>
  </v-app>
</template>

<script>
import Navbar from "@/components/nav/Menubar";
export default {
  components: {
    Navbar,
  },
  data() {
    return {
      login : false,
    };
  },
  
  methods: {
    Login(isTrue){
      this.login = isTrue;
    },
    logout(isFalse){
      this.login = isFalse;
    }
  },
};
</script>


<style>
 #app {
   background: #EFEFEF;
 }
</style>