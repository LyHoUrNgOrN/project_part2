<template>
  <Base-form>
    <router-link to="/signupone" class="btn signin">Sign up </router-link>
    <template #signup class="signin">
      <h1 class="text-center ma-3">Sign In Account</h1>
      <form action="#" @submit.prevent>
        <p>
          <label
            >Please input your email<span class="red--text"> *</span></label
          >
          <input
            type="text"
            placeholder="Email Address"
            v-model="email"
            required
          />
        </p>
        <p>
          <label
            >Please input your password<span class="red--text"> *</span></label
          >
          <input
            type="password"
            placeholder="Password"
            v-model="password"
            minlength="8"
            required
          />
        </p>
        <p v-if="messageAlert != ''">
          <label for="#">{{ messageAlert }}</label>
        </p>
        <p>
          <router-link to="/profile-view">
            <button class="next" @click="signIn">Sign In</button>
          </router-link>
          <!-- <input class="next" type="submit" value="Next" click="signIn"/> -->
        </p>
        <p>
          <!-- <a href="">Forget password?</a> -->
        </p>
      </form>
    </template>
  </Base-form>
</template>

<script>
import axios from "@/api/api.js";
export default {
  data() {
    return {
      messageAlert: "",
      email: "",
      password: "",
    };
  },
  methods: {
    signIn() {
      let user = new FormData();
      user.append("email", this.email);
      user.append("password", this.password);
      // axios.post('/signin',user).then(res=>{
      //     if(res.data == 'Invalid email or password'){
      //         this.messageAlert = res.data
      //     }else {
      //         this.$router.push('/home');
      //     }
      // })
      axios
        .post("/signin", user)
        .then((res) => {
          let user = res.data.user;
          console.log(user);
          // this.$emit("sign-in",user);
          this.$router.push("/");
        })
        .catch((error) => {
          if (error.response) {
            this.messageError = error.response.data.message;
            console.log(error.response.data.message);
          }
        });
    },
  },
};
</script>

<style scoped>
form input {
  width: 100%;
  margin-top: 15px;
}
.next {
  width: 100%;
  margin-top: 10px;
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
.signin {
  margin-top: -20px;
}
</style>


