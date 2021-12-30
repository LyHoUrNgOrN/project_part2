<template>
  <div class="all-card">
    <v-card width="50%" class="ma-auto">
      <div class="image pa-2 pl-5 d-flex">
        <img
          src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
          alt=""
          width="90"
        />
        <h3 class="pa-3 pl-2">Passerelles Numeriques Cambodia
          <p>A Getway for life</p>
        </h3>
      </div>
      <div class="d-flext mt-3" align="center" justify="space-around">
        <span>
          <v-icon large class="text-h2 red--text">mdi-alert</v-icon>
        </span>
        <h2 class="red--text">
          Failed create account.
        </h2>
      </div>

      <v-container fluid v-if="show_details">
        <v-card-text class="pb-10">
          <h3>Please contact to ERO Team or Admin!</h3>
          <h4 class="cyan--text">Admin</h4>
          <div class="txt">
            <h5 class="sub-txt">Name</h5>
            <span>: Somnang Chan</span>
          </div>
          <div class="txt">
            <h5 class="sub-txt">Phone</h5>
            <span>: +855 54 12 123</span>
          </div>
          <div class="txt">
            <h5 class="sub-txt">Email</h5>
            <span>: somnang.chan@admin.passerellesnumeriques.org</span>
          </div>
          <h4 class="cyan--text">ERO Team</h4>
          <div class="txt">
            <h5 class="sub-txt">Name</h5>
            <span>: Synich Ly</span>
          </div>
          <div class="txt">
            <h5 class="sub-txt">Phone</h5>
            <span>: +855 54 12 123</span>
          </div>
          <div class="txt">
            <h5 class="sub-txt">Email</h5>
            <span>: synich.ly@ero.passerellesnumeriques.org</span>
          </div> 
          <slot></slot>
          <router-link :to="path">
            <v-btn class="cyan float-end white--text pa-3 rounded-pill"> &#x2B05;Back </v-btn>
          </router-link>
        </v-card-text>
      </v-container>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      path : '',
      show_details: true,
      cruds: [],
    };
  },
  methods: {
    details() {
      this.show_details = !this.show_details;
    },
    image(e) {
      console.log(e.target.files[0]);
    },
  },
  mounted() {
    this.path = localStorage.getItem('path');
  },
};
</script>


<style scoped>
.txt {
  display: flex;
  margin-left: 4%;
}
.sub-txt {
  width: 220px;
}
.txt span {
  margin: 5px;
}
.image {
  background: #44c7f5;
}
</style>
