<template>
  <div>
    <Base-form>
      <router-link to="/signupone" class="btn signin">Sign up </router-link>
      <template #signup class="signin">
        <h1 class="text-center ma-3">Sign In Account</h1>
        <form action="#" @submit.prevent>
          <p class="mt-7">
            <label
              >Please input your email<span class="red--text"> *</span></label
            >
            <v-text-field
              hide-details="auto"
              outlined
              dense
              v-model="email"
              :rules="emailRules"
              label="E-mail"
              class="mt-2 rounded-pill"
            ></v-text-field>
          </p>
          <p class="mt-7">
            <label
              >Please input your password<span class="red--text">*</span></label
            >
            <v-text-field
              hide-details="auto"
              outlined
              dense
              v-model="password"
              class="password rounded-pill mt-2"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min, rules.max]"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="Password"
              hint="At least 6 characters"
              @click:append="show1 = !show1"
            ></v-text-field>
          </p>

          <p>
            <v-btn color="cyan white--text mt-3 rounded-pill" width="100%" @click="signIn"
              >Sign In</v-btn
            >
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
      show1: false,
      email: "",
      password: "",
      rules: {
        required: (value) => !!value || "Password is required.",
        min: (v) => v.length >= 6 || "Min 6 characters",
      },
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
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
              this.$router.push("/profile-view");
            }).catch((err) => {
              this.message = err.response.data.message;
            });
            
          })
          .catch((error) => {
            if (error.response) {
              this.passwordError = error.response.data.message;
            }
          });
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


