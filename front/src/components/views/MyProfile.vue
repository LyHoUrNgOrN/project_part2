<template>
   <v-container>
     <v-layout row wrap>
          <v-avatar
            color="primary"
            size="56"
          ></v-avatar>

          <v-card-text>
              <div class="subheading">Firstname: {{ firstname }}</div>
              <div class="grey--text">Lastname: {{ lastname}}</div>
              <div class="grey--text">Email: {{ email }}</div>
            </v-card-text>
      </v-layout>
   </v-container>
</template>


<script>
export default {
  data() {
    return {
      infors:{
        firstname: "Lyhor",
        lastname: "GG",
        email: "Lyhor@gmail.com"
      }
    };
  },
};
</script>