<template>
  <div>
    <v-main>
      <v-card class="mx-auto mt-10 pa-8">
        <v-container fluid class="d-flex" v-if="show_details">
          <div class="profile me-16">
            <img
              src="https://cahsi.utep.edu/wp-content/uploads/kisspng-computer-icons-user-clip-art-user-5abf13db5624e4.1771742215224718993529.png"
              alt
              width="190"
            />

            <!-- <input type="file" id="myFileInput" @change="image" hidden /> -->
            <v-btn
              rounded
              color="cyan white--text"
              width="200"
              onclick="document.getElementById('myFileInput').click()"
            >Change Logo</v-btn>
          </div>
          <v-card-text class="text-h5 mt-10">
            <div class="txt">
              <span class="sub-txt">Company name </span>
              <div><span>: <span></span>{{view_company_name}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company phone</span>
              <div><span>: <span></span>{{view_company_phone}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company email </span>
              <div><span>: <span></span>{{view_company_email}}</span></div>
            </div>
          </v-card-text>
        </v-container>

        <v-list>
          <v-list-group
            @click="details"
            :value="false"
            rounded
            prepend-icon="mdi-account-circle"
            style="background : #EFEFEF"
          >
            <template v-slot:activator>
              <v-list-item-title>Users Detail</v-list-item-title>
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background : #fff"
              link
            >
              <v-list-item-title class="ml-16" width="auto" v-text="title"></v-list-item-title>

              <v-list-item-title v-text="name"></v-list-item-title>
              <v-list-item-icon></v-list-item-icon>
            </v-list-item>
          </v-list-group>
        </v-list>

        <v-row>
          <v-spacer></v-spacer>
          <v-col cols="auto">
            <v-dialog transition="dialog-top-transition" max-width="600" v-model="dialog">
              <template v-slot:activator="{ on, attrs }">
                <v-btn class="white--text" color="#44C7F5" v-bind="attrs" v-on="on">+Add Information</v-btn>
                <v-btn class="green lighten-1 white--text ml-4">Edit Information</v-btn>
              </template>

              <template>
                <v-card>
                  <v-toolbar color="primary" class="name" dark>Companies Information</v-toolbar>
                  <v-card-text>
                    <v-row>
                      <v-col cols="6">
                        <p>
                          Companies
                          <span class="red--text">*</span>
                        </p>
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
                        <p>
                          Human Resources
                          <span class="red--text">*</span>
                        </p>
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
                    <v-btn color="cyan white--text" text @click="cancle">Cancel</v-btn>
                    <v-btn text @click="my_company">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </template>
            </v-dialog>
          </v-col>
        </v-row>
      </v-card>
      <h1>Work experince</h1>
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

      rules: [value => !!value || "Required."],
      current_position: "",
      hr_name: "",
      company_name: "",
      hr_email: "",
      company_phone: "",
      hr_phone: "",
      company_email: "",
      company_address: "",
      company_website: "",
      view_company_name: "",
      view_company_email: "",
      view_company_phone: "",
      id: 0,
      cruds: [],

      show_details: true
    };
  },
  methods: {
    cancle() {
      this.dialog = false;
    },
    details() {
      console.log("hello");
    },
    close() {
      this.getUser();
      this.dialog = false;
    },
    my_company() {
      let user_id = JSON.parse(localStorage.getItem("user"));
      this.id = user_id.id;
      console.log(this.id);
      let info = {
        user_id: this.id,
        current_position: this.current_position,
        company_name: this.company_name,
        company_phone: this.company_phone,
        company_email: this.company_email,
        company_address: this.company_address,
        company_website: this.company_website,
        hr_name: this.hr_name,
        hr_email: this.hr_email,
        hr_phone: this.hr_phone
      };
      axios.post("http://127.0.0.1:8000/api/companies", info).then(res => {
        console.log(res.data);
        this.cancle();
        this.companies = res.data;
        this.current_position = "";
        this.hr_name = "";
        this.company_name = "";
        this.hr_email = "";
        this.company_phone = "";
        this.hr_phone = "";
        this.company_email = "";
        this.company_address = "";
        this.company_website = "";
      });
    },

    getUser() {
      let user = JSON.parse(localStorage.getItem("user"));
      axios
        .get("http://127.0.0.1:8000/api/companies")
        .then(result => {
          result.data.forEach(element => {
            if (element.user_id === user.id) {
              this.view_company_name = element.company_name;

              this.view_company_email = element.company_email;

              this.view_company_phone = element.company_phone;
              this.cruds = [
                ["Company name", element.company_name],
                ["Current Position", element.current_position],
                ["Company Email", element.company_email],
                ["Company Phone", element.company_phone],
                ["Company Website", element.company_website],
                ["Company Address", element.company_address],
                ["Human Resources"],
                ["HR Name", element.hr_name],
                ["HR Email", element.hr_email],
                ["HR Phone", element.hr_phone]
              ];
            }
          });
        })
        .catch(err => {
          console.log(err.response.data.message);
        });
    }
  },
  mounted() {
    this.getUser();
  }
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