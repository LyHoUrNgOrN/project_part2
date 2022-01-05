<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg mt-5" width="80%">
        <v-container fluid class="container mx-auto ml-10">
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
                    v-bind="attrs"
                    :disabled="btn_disabled"
                    class="mt-6 rounded-pill white--text"
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
                    <v-icon
                      class="float-right text-h4 pa-1"
                      @click="dialog = false"
                      >mdi-window-close</v-icon
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
                      class="rounded white--text"
                      color="#44C7F5"
                      onclick="document.getElementById('myFileInput').click()"
                      ><v-icon>mdi-plus</v-icon>Upload Photo
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                      class="rounded white--text"
                      color="#44C7F5"
                      @click="updateProfile"
                    >
                      Save
                    </v-btn>
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
            max-width="600px"
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
                  <v-row class="card mt-2">
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
                        :rules="rules"
                        v-model="province"
                        dense
                        hide-details="auto"
                        outlined
                      ></v-select>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        label="Phone "
                        :rules="rules"
                        v-model="phone"
                        hide-details="auto"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        class="rounded-pill"
                        label="PNC Batch "
                        v-model="batch"
                        :rules="rules"
                        hide-details="auto"
                        outlined
                        dense
                      />
                    </v-col>
                    <v-col cols="12">
                      <label for>
                        Please input your PNC Major
                        <!-- <span class="red--text">*</span> -->
                      </label>
                      <v-select
                        :items="items"
                        label="PNC Major"
                        dense
                        class="rounded-pill mt-2"
                        outlined
                        :rules="rules"
                        hide-details="auto"
                        v-model="major"
                      ></v-select>
                    </v-col>

                    <v-col cols="12">
                      <div class="email">
                        <v-text-field
                          class="rounded-pill"
                          :rules="emailRules"
                          label="Email "
                          v-model="email"
                          hide-details="auto"
                          outlined
                          dense
                        />
                      </div>
                    </v-col>
                    <div class="gender">
                      <v-radio-group v-model="gender" row hide-details="auto">
                        <span class="mr-2">Gender:</span>
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
                  <v-btn color="red lighten-4" @click="cancel" class="red--text">Cancel</v-btn>
                  <v-btn
                    
                    @click="edit_info_alumni"
                    color="success"
                    v-if="detail !== null"
                    >Update</v-btn
                  >
                  <v-btn @click="add_info_ero_admin" color="primary" v-else
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

      <v-card
        class="mx-auto pa-5 mt-8"
        width="80%"
        v-if="user.role !== 'ADMIN' && user.role !== 'ERO'"
      >
        <div class="d-flex justify-space-between">
          <v-card-title class="text-h4 cyan--text ml-10">Skill</v-card-title>
          <v-dialog v-model="dialogSkill" persistent max-width="600px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                class="mr-5"
                v-bind="attrs"
                small
                fab
                color="#44C7F5"
                v-on="on"
              >
                <v-icon color="#ffffff"> mdi-plus </v-icon>
              </v-btn>
            </template>
            <v-card>
              <v-card-title ripple>
                <span class="text-h6 ma-auto font-weight-black" color="#44C7F5"
                  >Add New Skill
                </span>
                <v-icon large @click="cancelSkill(false)"
                  >mdi-window-close</v-icon
                >
              </v-card-title>
              <v-divider width="100%" />
              <v-text-field
                hide-details="auto"
                outlined
                dense
                :rules="rules"
                label="Skill Name..."
                class="mt-2 rounded-pill pa-10"
                v-model="newSkillName"
              ></v-text-field>
              <v-divider width="100%" />
              <v-card-actions class="pa-2 justify-end">
                <v-btn
                  v-if="openBtn == 'update'"
                  class="rounded white--text mt-2 mr-4"
                  color="#44C7F5"
                  @click="confirmUpdate"
                  >Update</v-btn
                >
                <v-btn
                  v-else
                  class="rounded white--text mt-2 mr-4"
                  color="#44C7F5"
                  @click="creatNewSkill"
                >
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>

        <div class="ml-12">
          <v-chip
            v-for="(skill, index) in skills"
            :key="index"
            color="#000000"
            class="ma-2 mt-3 pa-4"
            outlined
            >{{ skill.skill_name }}
            <v-icon class="iconSkillEdit ml-2" @click="updateSkill(skill)"
              >mdi-border-color</v-icon
            >

            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this skill?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="red lighten-4" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteSkill(skill)"
                    >OK</v-btn
                  >
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>

            <v-icon class="iconSkillDelete ml-1" @click="deleteItemConfirm"
              >mdi-close-circle</v-icon
            >
          </v-chip>
        </div>
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
      btn_disabled: true,
      role: "",
      dialog_eidt: false,
      dialog: false,
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      rules: [(value) => !!value || "Required."],
      skill_id: 0,
      skill_name: "",
      skillEdit: "",
      openBtn: "",
      skills: [],
      newSkillName: "",
      showDialog: false,
      dialogSkill: false,
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
      btn_save: true,
      user_id: 0,
      id: 0,
      dialogDelete:false,
    };
  },
  methods: {
    closeDelete(){
      this.dialogDelete = false
    },
    deleteItemConfirm(){
      this.dialogDelete = true
    },
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
        .then(() => {
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
        user_id: this.editUserID,
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
          if (this.editProfileID != null) {
            axios
              .put("/user_details/" + this.editProfileID, user_detail)
              .then(() => {
                this.getAllData();
              })
              .catch(() => {
               
              });
          }
        })
        .catch(() => {
        
        });
    },
    get_data_edit() {
      axios
        .get("/user/" + this.editUserID)
        .then((result) => {
          this.editProfileID = result.data.user_details.id;
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
        .catch(() => {
         
        });
    },

    getAllSkill() {
      this.dialogSkill = false;
      this.user = JSON.parse(localStorage.getItem("user"));
      axios.get("/skills/" + this.user.id).then((res) => {
        this.skills = res.data;
      });
    },
    saveSkill() {
      this.openBtn = "create";
      this.dialogSkill = true;
      this.creatNewSkill();
    },

    creatNewSkill() {
      let newSkill = {
        user_id: JSON.parse(localStorage.getItem("user")).id,
        skill_name: this.newSkillName,
      };
      axios.post("/skills/", newSkill).then((res) => {
        this.skill = res.data;
        this.getAllSkill();
      });
      this.dialogSkill = false;
      this.newSkillName = "";
    },
    deleteSkill(skill) {
      this.closeDelete()
      axios.delete("/skills/" + skill.id).then(() => {
        this.newSkillName = "";
        this.getAllSkill();
      });
    },
    updateSkill(skill) {
      this.openBtn = "update";
      axios.get("/skills/" + skill.user_id).then((res) => {
        for (let getSkill of res.data) {
          if (skill.id === getSkill.id) {
            this.dialogSkill = true;
            this.skillEdit = getSkill;
            this.newSkillName = this.skillEdit.skill_name;
          }
        }
      });
    },
    confirmUpdate() {
      let updateSkill = {
        user_id: this.skillEdit.user_id,
        skill_name: this.newSkillName,
      };
      axios.put("/skills/" + this.skillEdit.id, updateSkill).then(() => {
        this.newSkillName = "";
        this.getAllSkill();
        this.openBtn = "";
      });
    },

    changeFile(e) {
      this.imageFile = e.target.files[0];
      this.imageToDisplay = URL.createObjectURL(this.imageFile);
    },
    cancel() {
      this.dialog_eidt = false;
    },

    cancelSkill(ifFalse) {
      this.showDialog = ifFalse;
      this.dialogSkill = ifFalse;
      this.newSkillName = "";
      this.openBtn = "create";
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
              this.btn_disabled = false;
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
    this.getAllSkill();
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
  font-weight: bold;
  font-size: 2ch;
  width: 200px;
}
.txt span {
  margin: 5px;
}

.dote {
  font-weight: bold;
  font-size: 2ch;
}
.v-icon.iconSkillEdit {
  /* font-size: 20px; */
  color: #66bb6a;
}
.v-icon.iconSkillDelete {
  font-size: 20px;
  color: red;
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
