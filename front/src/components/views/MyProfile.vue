<template>
  <div>
    <v-main>
      <v-card class="mx-auto mt-15 pa-10" width="90%">
        <v-container fluid class="d-flex" v-if="show_details">
          <div class="profile me-16">
            <img
              src="https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png"
              alt=""
              width="190"
            />
            <input type="file" id="myFileInput" @change="image" hidden/>
            <v-btn rounded color="cyan white--text"  width="200" onclick="document.getElementById('myFileInput').click()">Change Profile</v-btn>
          </div>
          <v-card-text class="text-h5 mt-10">
            <div class="txt">
              <span class="sub-txt">First name</span>
              <span>: Chum</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Last name</span>
              <span>: YOEURN</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <span>: +855 54 12 123</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <span>: chum.yoeurn@gmail.com</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Province</span>
              <span>: Prey Veng</span>
            </div>
          </v-card-text>
        </v-container>
        <router-link to="/info-company">
          <v-btn>
            +Add Information about company
          </v-btn>
        </router-link>
        <v-list >
          <v-list-group @click="details" :value="false" rounded prepend-icon="mdi-account-circle" style="background : #EFEFEF">
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item  v-for="([title, name], i) in cruds" :key="i" style="background : #fff" link>
              <v-list-item-title class="ml-16" width="auto" v-text="title"></v-list-item-title>
              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon >
                <!-- <v-btn class="mx-2" fab dark small color="cyan">
                  <v-icon dark> mdi-pencil </v-icon>
                </v-btn> -->
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>
        </v-list>
      </v-card>
    </v-main>
  </div>
</template>

<script>
export default {
  data() {
    return {
     show_details: true,
      cruds: [
        ["First name", "Chum"],
        ["Last name", "YOEURN"],
        ["Gender", "Male"],
        ["Date of brith", "22/02/2005"],
        ["Province", "Prey Veng"],
        ["Phone", "+885 67 12 123"],
        ["Email", "chum.yoeurn@student.passerellesnumeriques.org"],
        ["PNC Batch", "2021"],
        ["PNC Major", "WEP"],
        ["Current position", "Student at PNC"],
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
  mounted() {
    // console.log(localStorage.getItem('reload'))
    // if(localStorage.getItem('reload') == false){
      // localStorage.setItem('reload',true);
      // window.location.reload();
    // }
  },
};
</script>


<style scoped>
.txt {
  display: flex;
}
.sub-txt {
  width: 300px;
}
.txt span {
  margin: 5px;
}
</style>
