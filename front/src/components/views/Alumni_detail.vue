<template>
<div class="card">
    <v-main>
        <v-card class="mx-auto pa-2 rounded-lg" width="60%">
          
          <div class="profile">
              <v-img
                :src="'http://127.0.0.1:8000/storage/profiles/' + picture"
                alt=""
                width="160"
                height="160"
                style="border: 0.5px solid black"
                class="rounded-circle mt-8"
              ></v-img>
            </div>
          <h3 style="text-transform: uppercase">{{first_name}} {{last_name}}</h3>
         
         <v-divider
              :inset="inset"
            ></v-divider>
          <v-card-text>
            <h2>+ My data</h2>
          
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
                  <span class="dote">:</span><span> {{ gender }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Date of birth</span>
                <div>
                  <span class="dote">:</span><span> {{ date_of_birth }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Province</span>
                <div>
                  <span class="dote">:</span><span> {{ province }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">phone</span>
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
                <span class="sub-txt">PNC Batch</span>
                <div>
                  <span class="dote">:</span><span> {{ batch }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Current position</span>
                <div>
                  <span class="dote">:</span><span> {{ current_position }}</span>
                </div>
              </div>
              <h2>+ My working</h2>
              <div class="txt">
                <span class="sub-txt">Company name</span>
                <div>
                  <span class="dote">:</span><span> {{ company_name}}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Phone</span>
                <div>
                  <span class="dote">:</span><span> {{ company_phone }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Email</span>
                <div>
                  <span class="dote">:</span><span> {{ company_email }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Website</span>
                <div>
                  <span class="dote">:</span><span> {{ company_website }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Address</span>
                <div>
                  <span class="dote">:</span><span> {{ company_address }}</span>
                </div>
              </div>

              <h2>+ Human resources</h2>
              <div class="txt">
                <span class="sub-txt">Name</span>
                <div>
                  <span v-if="hr_name != null" class="dote">:</span><span> {{ hr_name }}</span>
                  <span v-if="hr_name == null" class="dote">:</span><span> Not complete yet</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Phone</span>
                <div>
                  <span class="dote">:</span><span> {{ hr_phone }}</span>
                </div>
              </div>
              <div class="txt">
                <span class="sub-txt">Email</span>
                <div>
                  <span class="dote">:</span><span> {{ hr_email }}</span>
                </div>
              </div>
            </v-card-text>
            <div class="back">
              <router-link :to="path">
                <v-btn
                  text class="btn black--text"
                    >Back
                </v-btn>
              </router-link>
            </div>
            
          </v-card>
    </v-main>
  </div>
</template>
<script>
import axios from "@/api/api.js"
export default {
  props: ['desserts'],
  data() {
    return {
        path : localStorage.getItem('path'),
        user : [],
        userDetail : [],
        //data
        first_name : '',
        last_name : '',
        gender: '',
        date_of_birth: '',
        phone : '',
        email_data : '',
        province : '',
        batch: '',
        current_position: '',
        picture: '',

        //working
        company_name: '',
        company_phone: '',
        company_email: '',
        company_website: '',
        company_address: '',
        company: [],

        //human resources
        hr_name: '',
        hr_phone: '',
        hr_email: ''

    };
  },
  methods: {
    getInfo(){
          this.first_name = this.user.first_name;
          this.last_name = this.user.last_name;
          this.phone = this.userDetail.phone;
          this.email = this.user.email;
          this.province = this.userDetail.province;
          this.date_of_birth = this.userDetail.date_of_birth;
          this.gender = this.userDetail.gender;
          this.batch = this.userDetail.batch;
          this.current_position = this.userDetail.current_position;
          this.picture = this.userDetail.picture;
          
          this.company_name = this.company.company_name
          this.company_phone = this.company.company_phone;
          this.company_email = this.company.company_email;
          this.company_website = this.company.company_website;
          this.company_address = this.company.company_address;

          this.hr_name = this.company.hr_name;
          this.hr_phone = this.company.hr_phone;
          this.hr_email = this.company.hr_email;
      
    // })
      
      
    },
    


  },
  mounted() {
    //  if(localStorage.getItem('showUserDetailId') != undefined){
        axios.get('/user/'+ localStorage.getItem('showUserDetailId')).then(res=>{
          this.user = res.data;
          axios.get('/user_details/'+ localStorage.getItem('showUserDetailId')).then(rest=>{
            this.userDetail = rest.data[0];
            axios.get('/company/'+ localStorage.getItem('showUserDetailId')).then(result=>{
              this.company = result.data[0];
              this.getInfo();
            })
          })
        })

    //  }
  }
}
</script>

<style scoped>

.container,
.txt{
  display: flex;
}

.sub-txt {
  font-weight: bolder;
  width: 350px;
  margin-right: 5%;
}
.txt span {
  margin: 5px;
}



.txt,
.sub-txt{
  margin-left: 15%;
}

.v-divider{
  margin-top: 2%;
}

.txt{
  text-transform: uppercase;
}

.profile{
  margin-left: 40%;
}

h2{
  margin-left: 13%;
  margin-top: 1.5%;
  margin-bottom: 1.5%;
  text-transform: uppercase
}
.txt,
.sub-txt,
.dote, h2{
  font-size: 1rem;
  color: black;
}

h3{
  margin-top: 2%;
  display: flex;
  text-align: center;
  justify-content: center;
}


.btn {
  margin-left: 88%;
  border-radius: 20px;
  margin-bottom: 2%;
  background: #44C7F5;

}

.btn:hover{
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
