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
            <v-btn rounded color="cyan white--text"  width="200" onclick="document.getElementById('myFileInput').click()">Change Logo</v-btn>
          </div>
          <v-card-text class="text-h5 mt-10">
            <div class="txt">
              <span class="sub-txt">Company name</span>
              <span>: Advanced Bank of Asia Ltd. (ABA Bank)</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <span>: 088 34 52 939</span>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <span>: aba@gmail.com</span>
            </div>
          </v-card-text>
        </v-container>

        <v-list >
          <v-list-group @click="details" :value="false" rounded prepend-icon="mdi-account-circle" style="background : #EFEFEF">
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item  v-for="([title, name], i) in cruds" :key="i" style="background : #fff" link>
              <v-list-item-title class="ml-16" width="auto" v-text="title"></v-list-item-title>

              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon >
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
        ["Company name", "Advanced Bank of Asia Ltd. (ABA Bank)"],
        ["Phone", "+855 23 235 333"],
        ["Email", "aba@gmail.com"],
        ["Website", "https://www.ababank.com"],
        ["Address", "148 Preah Sihanouk Blvd, Sangkat Boeung Keng Kang I, Khan Boeung Keng Kang, Phnom Penh, Cambodia Human resources"],

        ["Human resources"],

        ["Name", "Sara Vey"],
        ["Phone", "+855 23 235 333"],
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
.container,
.txt {
  margin-top: 20px;
}
.sub-txt {
  font-weight: bolder;
  width: 250px;
}
.txt span {
  margin: 5px;
}

@media (max-width: 960px) {
  .sub-txt {
    width: 100px;
  }
}
@media (max-width: 600px) {
  .container,
  .txt,
  .txt div {
    display: block;
  }
  .txt div span {
    margin: 10px;
  }
  .dote {
    display: none;
  }
}
</style>