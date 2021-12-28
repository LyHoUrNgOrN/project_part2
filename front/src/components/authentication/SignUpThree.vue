<template>
  <div>
    <Base-form>
      <template #back>
        <router-link to="/signuptwo">
          <a href class="btn">&#x2B05;Back</a>
        </router-link>
      </template>
      <router-link to="/signin" class="btn signin">Sign In</router-link>
      <template #signup>
        <div class="form">
          <form action @submit.prevent>
            <h1 class="one text-center mt-3">Sign Up Account</h1>
            <p>
              <input type="text" placeholder="Phone ..." v-model="phone" required />
            </p>
            <p>
              <input type="text" placeholder="Date of Birth ..." v-model="dateofbirth" required />
            </p>

            <p>
              <v-select :items="allProvinces" label=" Select Province " class="select" v-model="province" dense outlined></v-select>
            </p>

            <div class="formall">
              <p>
                <input type="text" class="email" placeholder="Email ..." v-model="email" required />
              </p>
              <p>
                <input type="text" placeholder="Password ..." v-model="password" required />
              </p>
              <p>
                <input type="text" placeholder="Current Position ..."  v-model="position" required />
              </p>
              <div class="gender">
                <div class="d-flex">
                  <span class="mt-7 me-5">Gender:</span>
                  <v-radio-group v-model="gender">
                    <div class="d-flex">
                      <v-radio label="Male" class="mt-2 me-3" color="#44c7f5" value="Male"></v-radio>
                      <v-radio label="Female" color="#44c7f5" value="Female"></v-radio>
                    </div>
                  </v-radio-group>
                </div>
              </div>
              <p>
                <button class="next" @click="signUpThree">Sign Up</button>
              </p>
            </div>
          </form>
        </div>
      </template>
    </Base-form>
  </div>
</template>



<script>
// import province from "@//canbodia.json";
import axios from "@/api/api.js";

export default {
  emits:['login'],
  data() {
    return {
      phone:'',
      id : '',
      allProvinces : [],
      dateofbirth: '',
      province: '',
      email: '',
      password: '',
      position: '',
      gender: '',
    }
  },
  methods: {
    signUpThree(){
      let user = JSON.parse(localStorage.getItem("user"));
      let name = user.name.split(" ");
      let userCreate = new FormData();
      userCreate.append('first_name',name[0]);
      userCreate.append('last_name',name[1]);
      userCreate.append('role','ALUMINI');
      userCreate.append('email',this.email);
      userCreate.append('password',this.password);
      axios.post('/signup',userCreate).then(res=>{
        localStorage.setItem("user",JSON.stringify(res.data));
        localStorage.setItem('userid',res.data.user.id);
        localStorage.setItem('role',res.data.user.role.toUpperCase());
        let userDetail = new FormData();
        userDetail.append('user_id',localStorage.getItem('userid'));
        userDetail.append('phone',this.phone);
        userDetail.append('date_of_birth',this.dateofbirth);
        userDetail.append('province',this.province);
        userDetail.append('batch',user.batch);
        userDetail.append('major',user.major);
        // userDetail.append('picture',null);
        userDetail.append('current_position',this.position);
        userDetail.append('gender',this.gender);
        axios.post('/user_details',userDetail).then(res=>{
          localStorage.setItem("login",true);
          localStorage.setItem("userDetail",JSON.stringify(res.data.data));
          this.$emit('login',true)
          this.$router.push('/profile-view');
        })
      })
    },
  },
  mounted() {
    axios.get('/countries').then(res=>{
      for(let province of res.data){
        this.allProvinces.push(province.name)
      }
    })
  },
}

</script>


<style scoped>
.gender {
  margin-top: -30px;
}
.one {
  margin-bottom: 20px;
}
.next {
  width: 100%;
  border: 1px solid #44c7f5;
  padding: 5px;
  margin-top: -20px;
  border-radius: 40px;
  color: #44c7f5;
}
.next:hover {
  background: #44c7f5;
  color: #fff;
}
.btn {
  text-align: center;
  display: inline-block;
  text-decoration: none;
  border-radius: 10px;
  color: #ffffff;
  outline: none;
  border: 1px solid #ffffff;
  box-shadow: inset 0 0 0 0 #ffffff;
  transition: 0.3s;
  padding: 6px;
  margin-top: -20px;
}
.btn:hover {
  color: #44c7f5;
  box-shadow: inset 150px 0 0 0 #ffffff;
}

.formall {
  margin-top: -37px;
}
.email {
  margin-top: 10px;
}
.select {
  border-radius: 30px;
}
.signin {
  margin: 10px;
}
</style>