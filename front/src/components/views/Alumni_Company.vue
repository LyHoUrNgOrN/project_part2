<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg mt-8" width="80%">
        <v-container fluid class="d-flex">
          <div class="profile me-16">
            <v-img
              :src="'http://localhost:8000/storage/profiles/' + nameImgLogo"
              alt=""
              width="190"
              height="190"
              style="border: 0.5px solid black"
              class="rounded-circle"
            ></v-img>
            <input type="file" id="myFileInput" @change="changeLogo" hidden />

            <v-row justify="center">
              <v-dialog v-model="dialog_logo" persistent max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="#44C7F5"
                    v-bind="attrs"
                    class="mt-6 rounded-pill white--text"
                    v-on="on"
                    :disabled="edit"
                  >
                    Logo company
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title ripple>
                    <span
                      class="text-h6 ma-auto font-weight-black"
                      color="#44C7F5"
                      >Update profile photo
                    </span>
                    <v-icon large @click="dialog_logo = false"
                      >mdi-close-circle-outline</v-icon
                    >
                  </v-card-title>
                  <v-divider width="100%" />
                  <v-container>
                    <img
                      class="ma-auto pa-5"
                      :src="imageToDisplayLogo"
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
                    <v-btn color="#44C7F5" @click="dialog_logo = false">
                      Cancel
                    </v-btn>
                    <v-btn color="#44C7F5" @click="updateLogo"> Save </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-row>
          </div>

          <v-card-text>
            <div class="txt">
              <span class="sub-txt">Current position </span>
              <div>
                <span class="dote"
                  >: <span></span>{{ view_current_position }}</span
                >
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company name </span>
              <div>
                <span class="dote">: <span></span>{{ view_company_name }}</span>
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company phone</span>
              <div>
                <span class="dote"
                  >: <span></span>{{ view_company_phone }}</span
                >
              </div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company email </span>
              <div>
                <span class="dote"
                  >: <span></span>{{ view_company_email }}</span
                >
              </div>
            </div>
          </v-card-text>
        </v-container>
        <v-row>
          <v-spacer></v-spacer>
          <v-col cols="auto">
            <v-dialog
              transition="dialog-top-transition"
              max-width="600"
              v-model="dialog"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  class="white--text"
                  color="#44C7F5"
                  v-bind="attrs"
                  v-on="on"
                  :disabled="add"
                  @click="add_info"
                  >+Add Information</v-btn
                >
                <v-btn
                  class="green lighten-1 white--text ma-4"
                  @click="eidt_info"
                  :disabled="edit"
                  >Edit Information</v-btn
                >
              </template>

              <template>
                <v-card>
                  <v-toolbar color="primary" class="name" dark
                    >Companies Information</v-toolbar
                  >
                  <v-card-text>
                    <v-row>
                      <v-col cols="6">
                        <p>Companies<span class="red--text">*</span></p>
                        <v-text-field
                          class="rounded-pill"
                          label="Current position ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="current_position"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <p>Companies<span class="red--text">*</span></p>
                        <v-text-field
                          class="rounded-pill"
                          label="HR name ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="hr_name"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="Company name ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_name"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="HR email ..."
                          :rules="HrEmail"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="hr_email"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="Comapny phone ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_phone"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          class="rounded-pill"
                          label="HR phone ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="hr_phone"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12">
                        <v-text-field
                          class="rounded-pill"
                          label="Company email ..."
                          :rules="CompanyEmail"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_email"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          class="rounded-pill"
                          label="Company address ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_address"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          class="rounded-pill"
                          label="Company website ..."
                          :rules="rules"
                          hide-details="auto"
                          outlined
                          dense
                          v-model="company_website"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-card-text>
                  <v-card-actions class="justify-end">
                    <v-btn text @click="cancle">Cancel</v-btn>
                    <v-btn
                      v-if="btn_save"
                      color="blue white--text"
                      text
                      @click="createInfoCompany"
                      >Save</v-btn
                    >
                    <v-btn
                      v-else
                      color="success white--text"
                      text
                      @click="editInfoCompany"
                      >Update</v-btn
                    >
                  </v-card-actions>
                </v-card>
              </template>
            </v-dialog>
          </v-col>
        </v-row>

        <v-list>
          <v-list-group
            :value="false"
            rounded
            prepend-icon="mdi-account-circle"
            style="background: #efefef"
          >
            <template v-slot:activator>
              <v-list-item-title class="sub-txt"
                >Users Detail</v-list-item-title
              >
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background: #fff"
              link
            >
              <v-list-item-title
                class="ml-16 sub-txt"
                width="auto"
                v-text="title"
              ></v-list-item-title>

              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon></v-list-item-icon>
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
      HrEmail: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
      ],
      CompanyEmail: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
      ],
      dialog: false,
      dialog_logo: false,
      imgLogoFile: null,
      nameImgLogo: "",
      imageToDisplayLogo:
        "https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png",

      rules: [(value) => !!value || "Required."],
      current_position: "",
      company_name: "",
      company_email: "",
      company_address: "",
      company_website: "",
      company_phone: "",
      hr_name: "",
      hr_email: "",
      hr_phone: "",
      view_current_position: "Complate your current position",
      view_company_name: "Complate company name",
      view_company_email: "Complate company email",
      view_company_phone: "Complate company phone",
      userDetail_id: 0,
      user_id: 0,
      editInfoCompanyID: 0,
      btn_save: true,
      add: false,
      edit: true,
      cruds: [
        ["About Company *"],
        ["Current Position", "Complate your current position"],
        ["Company Name", "Complate company name"],
        ["Company Email", "Complate company email"],
        ["Company Phone", "Complate company phone"],
        ["Company Website", "Complate company website"],
        ["Company Address", "Complate company address"],
        ["Human Rescuse *"],
        ["HR Name", "Complate company HR name"],
        ["HR Email", "Complate company HR email"],
        ["HR Phone", "Complate company HR phone"],
      ],
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  methods: {
    changeLogo(e) {
      this.imgLogoFile = e.target.files[0];

      this.imageToDisplayLogo = URL.createObjectURL(this.imgLogoFile);
    },
    updateLogo() {
      let profile = new FormData();
      profile.append("picture", this.imgLogoFile);
      profile.append("_method", "PUT");
      axios
        .post("/updateProfileCompany/" + this.editInfoCompanyID, profile)
        .then((res) => {
          this.nameImgLogo = res.data.img.picture;
          console.log(res.data);
          this.dialog_logo = false;
          this.getAllData();
        });
    },
    editInfoCompany() {
      let info = {
        user_id: this.user_id,
        user_detail_id: this.userDetail_id,
        current_position: this.current_position,
        company_name: this.company_name,
        company_phone: this.company_phone,
        company_email: this.company_email,
        company_address: this.company_address,
        company_website: this.company_website,
        hr_name: this.hr_name,
        hr_email: this.hr_email,
        hr_phone: this.hr_phone,
      };
      this.cancle();
      axios
        .put(
          "http://127.0.0.1:8000/api/companies/" + this.editInfoCompanyID,
          info
        )
        .then(() => {
          this.getInFoCompany();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    add_info() {
      this.btn_save = true;
      this.dialog = true;
      this.user_id = "";
      this.user_detail_id = "";
      this.current_position = "";
      this.company_name = "";
      this.company_email = "";
      this.company_phone = "";
      this.company_address = "";
      this.company_website = "";
      this.hr_name = "";
      this.hr_email = "";
      this.hr_phone = "";
    },
    eidt_info() {
      this.btn_save = false;
      axios
        .get("http://127.0.0.1:8000/api/companies/" + this.editInfoCompanyID)
        .then((result) => {
          this.user_id = result.data.user_id;
          this.user_detail_id = result.data.user_detail_id;
          this.current_position = result.data.current_position;
          this.company_name = result.data.company_name;
          this.company_email = result.data.company_email;
          this.company_phone = result.data.company_phone;
          this.company_address = result.data.company_address;
          this.company_website = result.data.company_website;
          this.hr_name = result.data.hr_name;
          this.hr_email = result.data.hr_email;
          this.hr_phone = result.data.hr_phone;
        })
        .catch(() => {});
      this.dialog = true;
    },
    cancle() {
      this.dialog = false;
    },
    createInfoCompany() {
      let user = JSON.parse(localStorage.getItem("user"));
      let userDetail = JSON.parse(localStorage.getItem("userDetail"));
      this.user_id = user.id;
      this.userDetail_id = userDetail.id;
      let info = {
        user_id: this.user_id,
        user_detail_id: this.userDetail_id,
        current_position: this.current_position,
        company_name: this.company_name,
        company_phone: this.company_phone,
        company_email: this.company_email,
        company_address: this.company_address,
        company_website: this.company_website,
        hr_name: this.hr_name,
        hr_email: this.hr_email,
        hr_phone: this.hr_phone,
      };
      this.cancle();
      axios
        .post("/companies", info)
        .then(() => {
          this.getInFoCompany();
        })
        .catch((error) => {
          this.message = error.response.data.message;
        });
    },
    getInFoCompany() {
      let user = JSON.parse(localStorage.getItem("user"));
      let userDetail = JSON.parse(localStorage.getItem("userDetail"));
      this.user_id = user.id;
      this.userDetail_id = userDetail.id;

      axios
        .get("http://127.0.0.1:8000/api/companies")
        .then((result) => {
          result.data.forEach((element) => {
            if (
              element.user_id === user.id &&
              element.user_detail_id === userDetail.id
            ) {
              this.add = true;
              this.edit = false;
              this.editInfoCompanyID = element.id;
              this.nameImgLogo = element.picture;
              this.view_current_position = element.current_position;
              this.view_company_name = element.company_name;
              this.view_company_email = element.company_email;
              this.view_company_phone = element.company_phone;
              this.cruds = [
                ["About Company *"],
                ["Current Position", element.current_position],
                ["Company Name", element.company_name],
                ["Company Email", element.company_email],
                ["Company Phone", element.company_phone],
                ["Company Website", element.company_website],
                ["Company Address", element.company_address],

                ["Human Rescuse *"],
                ["HR Name", element.hr_name],
                ["HR Email", element.hr_email],
                ["HR Phone", element.hr_phone],
              ];
            }
          });
        })
        .catch(() => {});
    },
  },
  mounted() {
    this.getInFoCompany();
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
}
</style>