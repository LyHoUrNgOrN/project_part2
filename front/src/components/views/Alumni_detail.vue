<template>
  <div>
    <v-main>
      <v-card class="mx-auto rounded-lg mt-8" width="55%">
        <router-link :to="path">
          <v-icon class="float-right text-h4 pa-1"> mdi-window-close </v-icon>
        </router-link>
        <div class="pa-5 m-auto">
          <div>
            <v-img
              :src="'http://127.0.0.1:8000/storage/profiles/' + picture"
              alt=""
              width="150"
              height="150"
              class="rounded-circle profile"

            ></v-img>
          </div>
          <h3 class="ml-5 mt-3" style="text-transform: uppercase; text-align: center;">
            {{ first_name }} {{ last_name }}
          </h3>
        </div>
        <v-divider></v-divider>

        <v-expansion-panels focusable multiple>
          <v-expansion-panel>
            <v-expansion-panel-header
              ><h3 class="cyan--text">
                <v-icon color="cyan">mdi-account-outline</v-icon> My data
              </h3></v-expansion-panel-header
            >
            <v-expansion-panel-content>
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
                <span class="sub-txt">Gender</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Gender not yet to complete": gender }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Date of birth</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Date of birth not yet to complete": date_of_birth }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Province</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Province not yet to complete": province }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">phone</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Phone not yet to complete": phone }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Email</span>
                <div>
                  <span class="dote">:</span><span> {{ email }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">PNC Batch</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Phone not yet to complete": batch }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Current position</span>
                <div>
                  <span class="dote">:</span
                  ><span> {{ company == null ? "Current position not yet to complete" :current_position }}</span>
                  
                </div>
              </div>
            </v-expansion-panel-content>
          </v-expansion-panel>
          <v-expansion-panel>
            <v-expansion-panel-header
              ><h3 class="cyan--text">
                <v-icon color="cyan">mdi-domain</v-icon> Working place
              </h3></v-expansion-panel-header
            >
            <v-expansion-panel-content>
              <h3 class="mt-3">Company</h3>
              <div class="txt">
                <span class="sub-txt">Company name</span>
                <div>
                  <span class="dote">:</span><span> {{ company == null ? "Company name not yet to complete" :company_name }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Phone</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Company phone not yet to complete": company_phone }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Email</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Company email not yet to complete": company_email }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Website</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Company website not yet to complete": company_website }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Address</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "Company address not yet to complete": company_address }}</span>
                </div>
              </div>

              <h3 class="mt-3">Human resources</h3>

              <div class="txt">
                <span class="sub-txt">Name</span>
                <div>
                 
                  <span class="dote">:</span><span> {{company == null ? "HR name not yet to complete": hr_name }}</span>
                 
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Phone</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "HR phone not yet to complete": hr_phone }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Email</span>
                <div>
                  <span class="dote">:</span><span> {{company == null ? "HR email not yet to complete": hr_email }}</span>
                </div>
              </div>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-card>
    </v-main>
  </div>
</template>
<script>
import axios from "@/api/api.js";
export default {
  props: ["desserts"],
  data() {
    return {
      path: localStorage.getItem("path"),
      //data
      first_name: "",
      last_name: "",
      gender: "",
      date_of_birth: "",
      phone: "",
      email: "",
      province: "",
      batch: "",
      current_position: "",
      picture: "",

      //working
      company: null,
      company_name: "",
      company_phone: "",
      company_email: "",
      company_website: "",
      company_address: "",


      //human resources
      hr_name: "",
      hr_phone: "",
      hr_email: "",
    };
  },
  methods: {
    all() {
      this.panel = [...Array(this.items).keys()].map((k, i) => i);
    },
  },
  mounted() {
    axios
      .get("/user/" + localStorage.getItem("showUserDetailId"))
      .then((res) => {
      
        this.company = res.data.company
       this.first_name = res.data.first_name
      this.last_name = res.data.last_name
      this.email =res.data.email;
     this.phone = res.data.user_details.phone
      this.province = res.data.user_details.province
      this.date_of_birth = res.data.user_details.date_of_birth;
      this.gender = res.data.user_details.gender;
      this.batch = res.data.user_details.batch;
      this.picture =res.data.user_details.picture;

      this.current_position = res.data.company.current_position;
      this.company_name = res.data.company.company_name;
      this.company_phone = res.data.company.company_phone;
      this.company_email = res.data.company.company_email;
      this.company_website = res.data.company.company_website;
      this.company_address = res.data.company.company_address;

      this.hr_name = res.data.company.hr_name;
      this.hr_phone = res.data.company.hr_phone;
      this.hr_email = res.data.company.hr_email;
     
      });

    //  }
  },
};
</script>

<style scoped>
.container,
.txt {
  display: flex;
}

.sub-txt {
  width: 250px;
 
}



.txt,
.sub-txt,
.dote {
  font-size: 1rem;
  margin: 7px 0px 0px 15px;
}
.profile {
  border: 1px solid cyan;
  margin-left: 50%;
  transform: translate(-50%,0%);
}
.btn {
  margin-left: 88%;
  border-radius: 20px;
  margin-bottom: 2%;
  background: #44c7f5;
}

.btn:hover {
  background: #cfdadf;
}
@media (max-width: 960px) {
  .sub-txt {
    width: 100px;
  }
}
@media (max-width: 600px) {
  .txt div span {
    margin: 10px;
  }
  .dote {
    display: none;
  }
}
</style>
