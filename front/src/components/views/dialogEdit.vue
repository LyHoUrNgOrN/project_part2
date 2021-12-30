<template> 
   <v-dialog persistent width="600" v-model="dialog" class="overlay">
      <v-card>
        <h2 id="edit">Do you want to update?</h2>
        <v-card-text>
          <input type="text" placeholder="firstName" v-model="firstname">
          <input type="text" placeholder="lastName" v-model="lastname">
          <div class="d-flex">
            <span class="mt-7 me-5">Gender:</span>
            <v-radio-group v-model="gender">
              <div class="d-flex">
                <v-radio label="Male" color="#44c7f5" value="Male"></v-radio>
                <v-radio label="Female" color="#44c7f5" value="Female"></v-radio>
              </div>
            </v-radio-group>
          </div>
            <p>
              <input type="text" placeholder="Date of Birth ..." v-model="date_of_birth" required />
              <v-select :items="allProvinces" label=" Select Province " class="select" v-model="province" dense outlined></v-select>
              <input type="text" placeholder="Phone ..." v-model="phone" required />
              <input type="text" placeholder="PNC Batch ..." v-model="pnc_batch" required />
              <input type="text" placeholder="Email" v-model="email" required />
            </p>
            <p>
              <label for>
              Please input your PNC Major
              <span class="red--text">*</span>
              </label>
              <select name="select" id="major" v-model="marjor" class="selectMarjor">
                <option disabled value="">Select Major</option>
                <option value="Web">WEB</option>
                <option value="SNA">SNA</option>
              </select>
            </p>
          </v-card-text>
         <v-divider></v-divider>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="cancel" color="primary " text >Cancel</v-btn>
            <v-btn @click="Update" color="success" text >Update</v-btn>
        </v-card-actions>
      
      </v-card>
   </v-dialog>
</template>

<script>
import axios from "@/api/api.js";
export default {
    // props: ['data'],
    // emits:['update', 'cancel'],

    data(){
      return{
        user : '',
        dialog: true,
        allProvinces : [],
        userDetail : '',
        firstname: '',
        lastname: '',
        pnc_batch: '',
        email: '',
        gender: '',
        date_of_birth: '',
        phone: '',
        province: '',
        marjor: ''
      }
    },

    methods:{
      Update(){
        let editUser = {
          first_name : this.firstname,
          last_name : this.lastname,
          email : this.email};
        axios.put('/user/'+ this.user.id, editUser).then(res=> {
          localStorage.setItem('user',JSON.stringify(res.data));
          let editUserDetail = {
            phone : this.phone,
            user_id : this.user.id,
            date_of_birth : this.date_of_birth,
            province : this.province,
            batch : this.pnc_batch,
            major : this.marjor,
            gender : this.gender,
          };
          axios.put('/user_details/'+JSON.parse(localStorage.getItem('userDetail')).id,editUserDetail).then(res=>{
            localStorage.setItem('userDetail',JSON.stringify(res.data));
            window.location.reload();
          })
        });
      },
      cancel(){
        this.$emit('cancel', false);
      }
    },
    mounted() {
      axios.get('/countries').then(res=>{
        for(let province of res.data){
          this.allProvinces.push(province.name)
        }
      })
      let id = JSON.parse(localStorage.getItem('user')).id;
      axios
        .get("/user/" + id)
        .then(result => {
          this.user = result.data;
            axios.get('/user_details/'+ id).then(res=> {
                this.userDetail = res.data[0];
                this.firstname = result.data.first_name;
                this.lastname = result.data.last_name;
                this.phone = this.userDetail.phone;
                this.date_of_birth = this.userDetail.date_of_birth;
                this.email = this.user.email;
                this.gender = this.userDetail.gender;
                this.province = this.userDetail.province;
                this.marjor = this.userDetail.major;
                this.pnc_batch = this.userDetail.batch;
            });
          
        })
        .catch((err) => {
          console.log(err.response.data.message);
         
        });
        
    },
    
}
</script>

<style scoped>

   .overlay {
      position: fixed;
      background: #fff;
      top: 5%;
      left: 35%;
      width: 35%;
      z-index: 100;
      border-radius: 10px;
      box-shadow: rgba(50, 74, 85, 0.26) 0px 2px 4px 0px, rgba(70, 97, 109, 0.178) 0px 2px 16px 0px;
  }
   h2{
    text-align: center;
    padding: 10px;
    color: #fff;
    background: rgb(108, 185, 226);
  }
  h3{
    text-align: center;
    padding: 10px;
    color: #fff;
    background: rgb(108, 185, 226);
  }
  input[type=text],
  input[type=email]
  input[type=select]
  {
      width: 100%;
      margin-top: 2%;
      padding: 5px;
      outline: none;
      border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  select{
      width: 30%;
      margin-left: 2%;
      padding: 2px;
      outline: none;
      border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }

  .v-select{
    margin-top: 2%;
  }
  
  
</style>
