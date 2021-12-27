<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg" width="80%">
        <v-container fluid class="container" v-if="show_details">
          <div class="profile me-16">
            <img
              src="https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png"
              alt=""
              width="190"
            />
            <input type="file" id="myFileInput" @change="image" hidden />
            <v-btn
              rounded
              color="cyan white--text"
              width="200"
              onclick="document.getElementById('myFileInput').click()"
              >Change Profile</v-btn
            >
          </div>
          <v-card-text>
            <div class="txt">
              <span class="sub-txt">First name</span>
              <div><span class="dote">:</span > <span> Chum</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Last name</span>
              <div><span class="dote">:</span><span> YOEURN</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <div><span class="dote">:</span><span> +855 54 12 123</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <div>
                <span class="dote">:</span><span> chum.yoeurn@gmail.com</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Province</span>
              <div><span class="dote">:</span><span> Prey Veng</span></div>
            </div>
          </v-card-text>
        </v-container>

        <v-list>
          <v-list-group
            @click="details"
            :value="false"
            rounded
            prepend-icon="mdi-account-circle"
            style="background: #efefef"
          >
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background: #fff"
              link
            >
              <v-list-item-title
                class="ml-16"
                width="auto"
                v-text="title"
              ></v-list-item-title>

              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon>
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
      // user_details:{
      //   first_name:"chum",
      //   last_name:"chum",
      //   gender:"chum",
      //   date_of_birth:"chum",
      //   province:"chum",
      //   email:"chum",
      //   pnc_batc:"chum",
      //   pnc_major:"chum",
      // }
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
    details() {
      console.log("dd");
      this.show_details = !this.show_details;
    },
    image(e) {
      console.log(e.target.files[0]);
    },
  },
};
</script>


<style scoped>
.container,
.txt {
  display: flex;
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
