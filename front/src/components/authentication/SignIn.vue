<template>
  <div>
    <Base-form>
      <router-link to="/signupone" class="btn signin">Sign up </router-link>
      <template #signup class="signin">
        <h1 class="text-center ma-3">Sign In Account</h1>
        <form action="#" @submit.prevent>
          <p>
            <label
              >Please input your email<span class="red--text"> *</span></label
            >
            <input type="text" placeholder="Email Address" v-model="email" />
            <small v-if="emailError != ''" style="color: red">{{emailError}}</small>
          </p>
          <p>
            <label
              >Please input your password<span class="red--text">*</span
              ></label
            >
            <input
              type="password"
              placeholder="Password"
              v-model="password"
              minlength="8"
            />
            <small v-if="passwordError != ''" style="color: red">{{passwordError}}</small>
          </p>
          <p v-if="messageAlert != ''">
            <label for="#">{{ messageAlert }}</label>
          </p>
          <p>
            <button class="next" @click="signIn">Sign In</button>
            <!-- <input class="next" type="submit" value="Next" click="signIn"/> -->
          </p>
          <p>
            <!-- <a href="">Forget password?</a> -->
          </p>
        </form>
      </template>
    </Base-form>
  </div>
</template>

<script>
import axios from "@/api/api.js";
export default {
  $emits: ["login"],
  data() {
    return {
      messageAlert: "",
      emailError: "",
      passwordError: "",
      email: "",
      password: "",
    };
  },
  methods: {
    
    signIn() {
      if (this.email !== "" && this.password !== "") {
        event.preventDefault();
        let user = {
          email: this.email,
          password: this.password,
        };
        axios
          .post("/signin", user)
          .then((res) => {
            let user = res.data.user;
            localStorage.setItem("role", user.role);
            localStorage.setItem("id", user.id);
            localStorage.setItem("user", JSON.stringify(user));
            this.$emit("login", true);
            axios.get("/user_details/" + user.id).then((res) => {
              localStorage.setItem("userDetail", JSON.stringify(res.data[0]));
            });
            this.$router.push("/profile-view");
          })
          .catch((error) => {
            if (error.response) {
              this.passwordError = error.response.data.message;
            }
          });
      } else {
        
        if (this.email === "") {
          this.emailError = "Email should not be empty!";
        }
        if (this.passwordError == "") {
          this.passwordError = "Password should not be empty!";
        }
      }
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


