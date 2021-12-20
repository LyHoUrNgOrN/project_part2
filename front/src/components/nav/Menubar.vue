<template>
  <nav>
    <v-toolbar color="#44C7F5">
      <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon @click="showSideBar"> </v-app-bar-nav-icon>
      </span>
      <v-toolbar-title class="avatar">
        <router-link to="/" tag="span" style="cursor: pointer" v-if="showUser">
        
            <v-img class="image"
              src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png" 
            ></v-img>
            

        </router-link>
      </v-toolbar-title>
      <v-toolbar-items class="btn">
                <v-btn
                    active-class="grey-5 white--text" class="profile white--text"
                    text
                    :to="{ path: '/profile-view' }"
                    >
                    My Profile
                </v-btn>

                <v-btn
                    active-class="grey-5 white--text" 
                    text
                    :to="{ path: '/company-view' }" class="company white--text"
                    >
                    My Company
                </v-btn>
            
        </v-toolbar-items>

      <v-spacer></v-spacer>
      
      <v-btn active-class="grey-5 blue--text" text :to="{ path: '/sign_in' }" class="logout blue--text">Sign Out</v-btn>
        
    
      
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

  data() {
    return {
      sidebar: false,
      size: 0,
      showUser: true,
    };
  },
  methods: {
    showSideBar() {
      this.sidebar = !this.sidebar;
    },
  },
  mounted() {
    if (window.innerWidth <= 600) {
      this.showUser = false;
    }
  },
};
</script>

<style lang="scss" scoped>
.btn{
margin-left: 35%;  
}

.company{
    margin-left: 35%;
}

.avatar{
    margin-left: 2px;
}

.logout{
    margin-left: 5px;
    border-radius: 20px;
    background: #fff;
    
}

.image{
  width: 55px;
  height: 55px;
}





</style>










