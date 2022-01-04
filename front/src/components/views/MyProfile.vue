<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg mt-8" width="80%">
        <v-container fluid class="container">
          <div class="profile me-16">
            <v-img
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
                    class="mt-6 rounded-pill"
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
              <span class="sub-txt"> First name</span>
              <div>
                <span class="dote">:</span><span> {{ first_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Last name</span>
              <div>
                <span class="dote">:</span> <span> {{ last_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Email</span>
              <div>
                <span class="dote">:</span><span> {{ email }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Phone</span>
              <div>
                <span class="dote">:</span
                ><span
                  >{{ detail == null ? "Phone not yet to complete" : phone }}
                </span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Province</span>
              <div>
                <span class="dote">:</span
                ><span>
                  {{
                    detail == null ? "Province not yet to complete" : province
                  }}</span
                >
              </div>
            </div>
          </v-card-text>
        </v-container>
        <v-col cols="auto">
          <v-dialog
            transition="dialog-top-transition"
            max-width="600"
            v-model="dialog_eidt"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-list-item-icon class="d-flex justify-end">
                <v-btn
                  color="green lighten-1 white--text"
                  v-bind="attrs"
                  v-on="on"
                  @click="get_data_edit"
                  >Edit your information</v-btn
                >
              </v-list-item-icon>
            </template>
            <template>
              <v-card>
                <v-toolbar color="primary" dark>
                  <h2>Do you want to update?</h2>
                </v-toolbar>
                <v-card-text>
                  <v-row class="card mt-5">
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        type="text"
                        :rules="rules"
                        label="First name"
                        v-model="first_name"
                        hide-details="auto"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        type="text"
                        :rules="rules"
                        label="Last name"
                        v-model="last_name"
                        hide-details="auto"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        type="date"
                        v-model="date_of_birth"
                        hide-details="auto"
                        :rules="rules"
                        label="Date of Birth"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="6">
                      <v-select
                        :items="allProvinces"
                        label=" Select Province "
                        class="rounded-pill"
                        v-model="province"
                        dense
                        hide-details="auto"
                        outlined
                      ></v-select>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        type="text"
                        placeholder="Phone ..."
                        v-model="phone"
                        hide-details="auto"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        type="text"
                        placeholder="PNC Batch ..."
                        v-model="batch"
                        hide-details="auto"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="12">
                      <label for>
                        Please input your PNC Major
                        <span class="red--text">*</span>
                      </label>
                      <v-select
                        :items="items"
                        label="PNC Major"
                        dense
                        class="rounded-pill mt-2"
                        outlined
                        hide-details="auto"
                        v-model="major"
                      ></v-select>
                    </v-col>

                    <v-col cols="12">
                      <div class="email">
                        <v-text-field
                          class="rounded-pill"
                          type="text"
                          placeholder="Email"
                          v-model="email"
                          hide-details="auto"
                          outlined
                          dense
                        />
                      </div>
                    </v-col>
                    <div class="gender">
                      <v-radio-group v-model="gender" row hide-details="auto">
                        <span class="mr-3">Gender:</span>
                        <v-radio label="Male" color="#44c7f5" value="Male">
                        </v-radio>
                        <v-radio
                          class=""
                          label="Female"
                          color="#44c7f5"
                          value="Female"
                        ></v-radio>
                      </v-radio-group>
                    </div>
                  </v-row>
                </v-card-text>
                <v-card-actions class="justify-end">
                  <v-btn text @click="cancel">Cancel</v-btn>
                  <v-btn
                    text
                    @click="edit_info_alumni"
                    color="success"
                    v-if="detail !== null"
                    >Update</v-btn
                  >
                  <v-btn text @click="add_info_ero_admin" color="success" v-else
                    >Save</v-btn
                  >
                </v-card-actions>
              </v-card>
            </template>
          </v-dialog>
        </v-col>
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
          </v-list-group>
        </v-list>
      </v-card>
    </v-main>
  </div>
</template>

<script>
import axios from "@/api/api.js";
export default {
  data() {
    return {
      detail: null,
      add_info: false,
      btn_disabled_ero_or_admin: true,
      role: "",
      dialog_eidt: false,
      dialog: false,
      rules: [(value) => !!value || "Required."],
      user: [],
      userDetail: "",
      first_name: "",
      last_name: "",
      email: "",

      phone: "",
      batch: "",
      major: "",
      date_of_birth: "",
      gender: "",
      province: "",
      cruds: [],
      allProvinces: [],
      items: ["WEP", "SNA"],
      name_img: "",
      imageToDisplay:
        "https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png",

      imageFile: null,
      editProfileID: 0,
      editUserID: 0,
    };
  },
  methods: {
    add_info_ero_admin() {
      this.cancel();
      let add_info_user = {
        user_id: this.editUserID,
        phone: this.phone,
        date_of_birth: this.date_of_birth,
        province: this.province,
        batch: this.batch,
        major: this.major,
        gender: this.gender,
        current_position: "NONE",
      };
      axios
        .post("/user_details/", add_info_user)
        .then((res) => {
          console.log(res.data);
          this.getAllData();
        })
        .catch(() => {});
    },
    edit_info_alumni() {
      this.cancel();
      let user = {
        first_name: this.first_name,
        last_name: this.last_name,
        email: this.email,
      };
      let user_detail = {
        user_id: this.eidtUserID,
        phone: this.phone,
        batch: this.batch,
        major: this.major,
        date_of_birth: this.date_of_birth,
        gender: this.gender,
        province: this.province,
      };
      axios
        .put("/user/" + this.editUserID, user)
        .then(() => {
          if(this.editProfileID != null){
            axios
            .put("/user_details/" + this.editProfileID, user_detail)
            .then(() => {
              this.getAllData();
            })
            .catch((err) => {
              console.log(err.response.data.message);
            });
          }

        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
    get_data_edit() {
      axios
        .get("/user/" + this.editUserID)
        .then((result) => {
          // this.editProfileID = result.data.id;
          this.first_name = result.data.first_name;
          this.last_name = result.data.last_name;
          this.email = result.data.email;

          this.phone = result.data.user_details.phone;
          this.batch = result.data.user_details.batch;
          this.major = result.data.user_details.major;
          this.date_of_birth = result.data.user_details.date_of_birth;
          this.gender = result.data.user_details.gender;
          this.province = result.data.user_details.province;
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
    changeFile(e) {
      this.imageFile = e.target.files[0];
      this.imageToDisplay = URL.createObjectURL(this.imageFile);
    },
    cancel() {
      this.dialog_eidt = false;
    },

    updateProfile() {
      this.dialog = false;
      let profile = new FormData();
      profile.append("picture", this.imageFile);
      profile.append("_method", "PUT");
      axios
        .post("/updateProfile/" + this.editProfileID, profile)
        .then((res) => {
          this.name_img = res.data.img.picture;
          this.getAllData();
        });
    },
    getAllData() {
      let user = JSON.parse(localStorage.getItem("user"));

      axios.get("/user/").then((res) => {
        res.data.forEach((element) => {
          if (user.email === element.email) {
            if (element.user_details === null && element.company === null) {
              this.editUserID = element.id;
              this.detail = element.company;
              this.role = element.role;
              this.first_name = element.first_name;
              this.last_name = element.last_name;
              this.email = element.email;
              this.cruds = [
                ["First name", element.first_name],
                ["Last name", element.last_name],
                ["Email", element.email],
                ["Gender", "Gender not yet to complete"],
                ["Date of brith", "Date of brith not yet to complete"],
                ["Province", "Province not yet to complete"],
                ["Phone", "Phone not yet to complete"],
                ["PNC Batch", "PNC Batch not yet to complete"],
                ["PNC Major", "PNC Major not yet to complete"],
              ];
            } else {
              this.detail = element.user_details;
              this.editUserID = element.id;
              this.editProfileID = element.user_details.id;
              this.name_img = element.user_details.picture;
              this.first_name = element.first_name;
              this.last_name = element.last_name;
              this.email = element.email;
              this.phone = element.user_details.phone;
              this.province = element.user_details.province;
              this.cruds = [
                ["First name", element.first_name],
                ["Last name", element.last_name],
                ["Email", element.email],
                ["Gender", element.user_details.gender],
                ["Date of brith", element.user_details.date_of_birth],
                ["Province", element.user_details.province],
                ["Phone", element.user_details.phone],
                ["PNC Batch", element.user_details.batch],
                ["PNC Major", element.user_details.major],
              ];
            }
          }
        });
      });
    },
  },
  mounted() {
    this.user = JSON.parse(localStorage.getItem("user"));
    this.editUserID = this.user.id;
    axios.get("/countries").then((res) => {
      for (let province of res.data) {
        this.allProvinces.push(province.name);
      }
    });
    this.getAllData();
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
