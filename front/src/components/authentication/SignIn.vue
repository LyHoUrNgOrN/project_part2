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
            <small class="red--text">{{ txt_err_email }}</small>
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
            <small class="red--text">{{ txt_err_pwd }}</small>
          </p>

          <p>
            <v-btn
              color="cyan white--text mt-3 rounded"
              width="100%"
              @click="signIn"
              :disabled="btn_signin_disabled"
            >
              <button type="submit">Sign In</button>
            </v-btn>
          </p>
          <v-alert type="error" :value="alert">
            Email or password wrong!</v-alert
          >
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
      alert: false,
      btn_signin_disabled: true,
      email: "",
      password: "",
      txt_err_email: "",
      txt_err_pwd: "",
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
  watch: {
    email() {
      if (this.email !== "" && this.password !== "") {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
      this.txt_err_email = "";
    },
    password() {
      if (this.email !== "" && this.password !== "") {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
      this.txt_err_pwd = "";
    },
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
            res.data.user.forEach((element) => {
              if (element.email === this.email) {
                localStorage.setItem("role", element.role);
                localStorage.setItem("id", element.id);
                localStorage.setItem("user", JSON.stringify(element));
                localStorage.setItem(
                  "userDetail",
                  JSON.stringify(element.user_details)
                );
                this.$emit("login", true);
                this.$router.push("/profile-view");
              }
            });
          })
          .catch((error) => {
            if (error.response.status === 401) {
              if (error.response.data.email_err !== "") {
                this.txt_err_email = error.response.data.email_err;
              }
              if (error.response.data.password_err !== "") {
                this.txt_err_pwd = error.response.data.password_err;
              }
            }
          });
      }
    },
  },
  // created() {
  //   setTimeout(() => {
  //     this.alert = false;
  //   }, 5000);
  // },
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


