<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg" width="80%">
        <v-container fluid class="container">
          <div class="profile me-16">
            <img
              v-if="name_img == null"
              src="https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png"
              alt=""
              width="190"
            />
            <v-img
              v-else
              :src="'http://localhost:8000/storage/profiles/' + name_img"
              alt=""
              width="190"
              height="190"
              style="border: 0.5px solid black"
              class="rounded-circle"
            ></v-img>
            <input type="file" id="myFileInput" @change="changeFile" hidden />

            <v-row justify="center">
              <v-dialog v-model="dialog" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="#44C7F5"
                    dark
                    v-bind="attrs"
                    class="mt-6"
                    v-on="on"
                  >
                    Change Profile
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title ripple>
                    <span
                      class="text-h6 ma-auto font-weight-black"
                      color="#44C7F5"
                      >Update profile photo
                    </span>
                    <v-icon large @click="dialog = false"
                      >mdi-close-circle-outline</v-icon
                    >
                  </v-card-title>
                  <v-divider width="100%" />
                  <v-container>
                    <img
                      class="ma-auto pa-5"
                      :src="imageToDisplay"
                      alt=""
                      width="200"
                    />
                  </v-container>
                  <v-divider width="100%" />
                  <v-card-actions class="pa-4">
                    <v-btn
                      color="#44C7F5"
                      onclick="document.getElementById('myFileInput').click()"
                      ><v-icon>mdi-plus</v-icon>Upload Photo
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="#44C7F5" @click="dialog = false">
                      Cancel
                    </v-btn>
                    <v-btn color="#44C7F5" @click="updateProfile"> Save </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-row>
          </div>
          <v-card-text>
            <div class="txt">
              <span class="sub-txt">First name</span>
              <div>
                <span class="dote">:</span> <span> {{ first_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Last name</span>
              <div>
                <span class="dote">:</span><span> {{ last_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <div>
                <span class="dote">:</span><span> {{ phone }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <div>
                <span class="dote">:</span><span> {{ email }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Province</span>
              <div>
                <span class="dote">:</span><span> {{ province }}</span>
              </div>
            </div>
          </v-card-text>
        </v-container>

        <v-list>
          <v-list-group
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
              style="background: #fff; cursor: default"
              link
            >
              <v-list-item-title
                class="ml-16"
                width="auto"
                v-text="title"
              ></v-list-item-title>
              <v-list-item-title v-text="name"></v-list-item-title>
            </v-list-item>
            <!-- test edit -->
            <v-list-item-icon class="d-flex justify-end">
              <v-btn @click="showDialog = true">Edit your information</v-btn
              ><v-icon color="dark darken-2" style="cursor: pointer">
                mdi-pencil
              </v-icon>
            </v-list-item-icon>
          </v-list-group>
        </v-list>
        <Dialog v-if="showDialog" @cancel="cancel" />
      </v-card>
    </v-main>
  </div>
</template>

<script>
import axios from "@/api/api.js";
import Dialog from "./dialogEdit.vue";
export default {
  components: {
    Dialog,
  },
  data() {
    return {
      showDialog: false,
      dialog: false,

      user: [],
      userDetail: "",
      first_name: "",
      last_name: "",
      phone: "",
      email: "",
      isReload: 0,
      province: "",
      cruds: [],
      name_img: "",
      imageToDisplay:
        "https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png",
      imageFile: null,
      show_img: true,
      id: 0,
    };
  },
  methods: {
    changeFile(e) {
      this.imageFile = e.target.files[0];
      this.imageToDisplay = URL.createObjectURL(this.imageFile);
    },
    cancel(ifFalse) {
      this.showDialog = ifFalse;
    },
    getUserDetail() {
      axios.get("/user_details/" + this.user.id).then((res) => {
        this.userDetail = res.data[0];
        this.first_name = this.user.first_name;
        this.last_name = this.user.last_name;
        this.phone = this.userDetail.phone;
        this.email = this.user.email;
        this.province = this.userDetail.province;
        this.cruds = [
          ["First name", this.first_name],
          ["Last name", this.last_name],
          ["Gender", this.userDetail.gender],
          ["Date of brith", this.userDetail.date_of_birth],
          ["Province", this.province],
          ["Phone", this.phone],
          ["Email", this.user.email],
          ["PNC Batch", this.userDetail.batch],
          ["PNC Major", this.userDetail.major],
        ];
      });
    },
    updateProfile() {
      this.dialog = false;
      let profile = new FormData();
      profile.append("picture", this.imageFile);
      profile.append("_method", "PUT");
      axios.post("/updateProfile/" + this.id, profile).then((res) => {
        this.name_img = res.data.img.picture;
        this.show_img = true;
        this.getAllData();
      });
    },
    getAllData() {
      this.user = JSON.parse(localStorage.getItem("user"));
      axios.get("/user_details/" + this.user.id).then((res) => {
        this.id = res.data[0].id;
        this.userDetail = res.data[0];
        this.first_name = this.user.first_name;
        this.last_name = this.user.last_name;
        this.phone = this.userDetail.phone;
        this.email = this.user.email;
        this.name_img = this.userDetail.picture;
        if (this.name_img !== this.imageToDisplay) {
          this.show_img = false;
        }
        this.province = this.userDetail.province;
        this.cruds = [
          ["First name", this.first_name],
          ["Last name", this.last_name],
          ["Gender", this.userDetail.gender],
          ["Date of brith", this.userDetail.date_of_birth],
          ["Province", this.province],
          ["Phone", this.phone],
          ["Email", this.user.email],
          ["PNC Batch", this.userDetail.batch],
          ["PNC Major", this.userDetail.major],
        ];
      });
    },
  },
  mounted() {
    this.getAllData();
    if (localStorage.getItem("id") != undefined) {
      axios.get("/user/" + localStorage.getItem("id")).then((res) => {
        this.user = res.data;
        localStorage.setItem("user", JSON.stringify(res.data));
        this.getUserDetail();
      });
    } else {
      this.user = JSON.parse(localStorage.getItem("user"));
      this.getUserDetail();
    }
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
