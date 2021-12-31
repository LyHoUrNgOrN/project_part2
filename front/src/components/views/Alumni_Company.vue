<template>
  <div>
    <v-main>
      <v-card class="mx-auto pa-2 rounded-lg" width="80%">
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
          <v-card-text>
            <div class="txt">
              <span class="sub-txt">Company name </span>
              <div><span  class="dote">: <span></span>{{view_company_name}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company phone</span>
              <div><span  class="dote">: <span></span>{{view_company_phone}}</span></div>
            </div>
            <div class="txt">
              <span class="sub-txt">Company email </span>
              <div><span class="dote">: <span></span>{{view_company_email}}</span></div>
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
              <v-list-item-title class="sub-txt">Users Detail</v-list-item-title>
            </template>

            <v-list-item
              v-for="([title, name], i) in cruds"
              :key="i"
              style="background : #fff"
              link
            >
              <v-list-item-title class="ml-16 sub-txt" width="auto" v-text="title"></v-list-item-title>

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
                <v-btn v-if="ifHaveInfo" class="white--text" color="#44C7F5" v-bind="attrs" v-on="on">+Add Information</v-btn>
                <v-btn v-else class="green lighten-1 white--text ml-4">Edit Information</v-btn>
              </template>

              <template>
                <v-card>
                  <v-toolbar color="primary" class="name" dark>Companies Information</v-toolbar>
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
                      <v-col cols="6" >
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
                    <v-btn color="blue white--text" text @click="createInfoCompany">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </template>
            </v-dialog>
          </v-col>
        </v-row>
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

      rules: [value => !!value || "Required."],
      current_position: "",
      hr_name: "",
      ifHaveInfo : true,
      company_name: "",
      companyId: "",
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
      user: [],

      show_details: true,

      //
      newInfo: [],


      //
    };
  },
  methods: {
    cancle() {
      this.dialog = false;
    },
    close() {
      // this.getUser();
      // this.getUserInfo();
      this.dialog = false;
    },
    createInfoCompany() {
      let newInfo = new FormData();
      newInfo.append("current_position", this.current_position);
      newInfo.append("company_name", this.company_name);
      newInfo.append("company_phone", this.company_phone); 
      newInfo.append("company_email", this.company_phone); 
      newInfo.append("company_address", this.company_address);
      newInfo.append("company_website", this.company_website); 
      newInfo.append("hr_name", this.hr_name); 
      newInfo.append("hr_email", this.hr_email); 
      newInfo.append("hr_phone", this.hr_phone);
      axios.post("/companies", newInfo)
        .then((res) => {
          let createInfo = {
            user_id: JSON.parse(localStorage.getItem("user")).id,
            company_id: res.data.data.id,
            role: "creator",
          };

        }).catch((error) => {
          this.closeDialog(true);
          this.message = error.response.data.message;

      });
      // let user_id = JSON.parse(localStorage.getItem("user"));
      // let user_detail_id = JSON.parse(localStorage.getItem("userdetail"));
      // this.id = user_id.id[0];
      // this.id = user_detail_id.id[0];
      // let info = {

      //   user_id: this.id[0],
      //   user_detail_id: this.id[0],
      //   current_position: this.current_position,
      //   company_name: this.company_name,
      //   company_phone: this.company_phone,
      //   company_email: this.company_email,
      //   company_address: this.company_address,
      //   company_website: this.company_website,
      //   hr_name: this.hr_name,
      //   hr_email: this.hr_email,
      //   hr_phone: this.hr_phone
      // };
      // axios.post("/companies", info).then(res => {
      //   console.log(res.data);
      //   this.dialog = true
      //   this.cancle();
      //   this.companies = res.data;
      // });

    
    },

    getUserInfo(){
      this.user = JSON.parse(localStorage.getItem('user'));
      axios.get('/companies/' + this.user.id).then(res=> {
      this.companyId = res.data[0];
      this.view_company_name = this.companyId.company_name;
      this.view_company_email = this.companyId.company_email;
      this.view_company_phone = this.companyId.company_phone;
      this.cruds = [
            ["About Company *"],
            ["Current Position", this.companyId.current_position],
            ["Company Name", this.companyId.company_name],
            ["Company Email", this.companyId.company_email],
            ["Company Phone", this.companyId.company_phone],
            ["Company Website", this.companyId.company_website],
            ["Company Address", this.companyId.company_address],

            ["Human Rescuse *"],
            ["HR Name", this.companyId.hr_name],
            ["HR Email", this.companyId.hr_email],
            ["HR Phone", this.companyId.hr_phone]
        ];
    })
    }
  },
  mounted() {
     if(localStorage.getItem('id') != undefined){
        axios.get('/companies/'+ localStorage.getItem('id')).then(res=>{
          this.user = res.data;
          localStorage.setItem('companies',JSON.stringify(res.data));
          this.getUserInfo();
        })
      }
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