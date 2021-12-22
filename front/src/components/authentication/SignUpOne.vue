<template>
  <Base-form>
    <router-link to="/signin" class="btn">Sign In</router-link>
    <template #signup>
      <div class="form">
        <form action="#" class="mb-10" @submit.prevent>
          <h1 class="one text-center">Sign Up Account</h1>
          <p>
            <label for>
              Please input your first name
              <span class="red--text">*</span>
            </label>
            <input v-model="first_name" type="text" placeholder="First name ..." required />
          </p>
          <p>
            <label for>
              Please input your last name
              <span class="red--text">*</span>
            </label>
            <input v-model="last_name" type="text" placeholder="Last name ..." required />
          </p>
          <p>
              <input @click="signup_one" class="next" type="submit" value="Next" />
           
          </p>
        </form>
      </div>
    </template>
  </Base-form>
</template>
<script>
import axios from '@/axios-http.js'
export default {
  data() {
    return {
      first_name:'',
      last_name: '',
    }
  },
  methods: {
    getUser(){
      axios.get("http://127.0.0.1:8000/api/user")
            .then(res=>{
              res.data.forEach(element => {
                if(element.first_name === this.first_name && element.last_name === this.last_name){
                  console.log(element);
                }
              });
            })
    },
    signup_one(){
      let signup = {
        'first_name':this.first_name.toLowerCase(),
        'last_name':this.last_name.toLowerCase(),
        'email': "a@gami.com",
        'role':"ERO"
      }
      this.getUser()
      axios.post("http://127.0.0.1:8000/api/signup",signup)
            .then(res=>{
              console.log(res.data);
            })
    }
  },
  mounted() {
    this.getUser()
  },
};
</script>

<style scoped>
.form {
  margin-top: 40px;
}
.one {
  margin-bottom: 20px;
}
.next {
  width: 100%;
  border: 1px solid #44c7f5;
  padding: 5px;
  border-radius: 40px;
  color: #44c7f5;
  margin-bottom: 20px;
}
.next:hover {
  background: #44c7f5;
  color: #fff;
}
p input {
  margin-top: 10px;
}
</style>