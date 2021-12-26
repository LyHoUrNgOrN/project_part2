<template>
  <div class="all-card">
      <v-card>
        <div class="image">
            <img
              src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
              alt=""
              width="110"
            />
        </div>
      </v-card>
        <v-alert class="alert"
        :value="true"
        type="error"
      >
        <span>Your sign up account failed! Please contact to ERO Team.</span>
      </v-alert>

        <v-container fluid class="d-flex" v-if="show_details">
          <v-card-text class="text-h5">
            <h4>Please contact to ERO Team or Admin!</h4>
            <h5>Admin</h5>
            <div class="txt">
              <span class="sub-txt">Name</span>
              <span>: Chum</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <span>: +855 54 12 123</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <span>: chum.yoeurn@gmail.com</span>
            </div>
            <h5>ERO Team</h5>
            <div class="txt">
              <span class="sub-txt">Name</span>
              <span>: Prey Veng</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <span>: +855 54 12 123</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <span>: chum.yoeurn@gmail.com</span>
            </div>
          </v-card-text>
          <router-link to="/warning" class="btn blue"><v-icon class="icon blue"
            left
          >
            mdi-arrow-left
          </v-icon>Back</router-link> 
        </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
     show_details: true,
      cruds: [
        
      ],
    };
  },
  methods: {
    details(){
      console.log('dd');
      this.show_details = !this.show_details
    },
    image(e){
      console.log(e.target.files[0]);
    },
  },
};
</script>


<style scoped>
.txt {
  display: flex;
  margin-left: 4%;
  
}
.sub-txt {
  width: 300px;
}
.txt span {
  margin: 5px;
}
.image{
  background: #44C7F5;

}
img{
  margin-left: 5%;
}
.all-card{
  width: 60%;
  margin-left: 20%;
  background: rgb(247, 248, 246);
}

.btn {
  margin-right: 5%;
  display: flex;
  color: #ffffff;
  border: 1px solid #ffffff;
  box-shadow: inset 0 0 0 0 #ffffff;
  border-radius: 10px;
  padding-right: 20px;
  padding-left: 20px;
  padding-top: 6px;
  padding-bottom: 6px;
  margin-top: 50%;
}
.icon{
  color: white;
}
.btn:hover {
  color: #44c7f5;
  box-shadow: inset 150px 0 0 0 #ffffff;
}
</style>
