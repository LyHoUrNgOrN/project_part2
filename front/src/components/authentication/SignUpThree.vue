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
          <form @submit.prevent>
            <h1 class="one text-center mt-3">Sign Up Account</h1>
            <v-text-field
              v-model="phone"
              type="number"
              label="Phone"
              :rules="[rulesphone.required, rulesphone.min, rulesphone.max]"
              hide-details="auto"
              outlined
              class="my-4 rounded-pill"
              dense
            ></v-text-field>
            <v-text-field
              dense
              type="date"
              :rules="[rulesphone.required]"
              v-model="dateofbirth"
              required
              outlined
              class="rounded-pill"
            ></v-text-field>
            <v-select
            :rules="[rulesphone.required]"
              :items="allProvinces"
              label=" Select Province "
              class="mb-8 rounded-pill"
              v-model="province"
              dense
              outlined
            ></v-select>

            <div class="formall">
              <v-text-field
                hide-details="auto"
                outlined
                dense
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                class="rounded-pill"
              ></v-text-field>
              <small class="red--text">{{ email_err }}</small>

              <v-text-field
                hide-details="auto"
                outlined
                dense
                v-model="password"
                class="password rounded-pill my-5"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required, rules.min, rules.max]"
                :type="show ? 'text' : 'password'"
                name="input-10-1"
                label="Password"
                hint="At least 6 characters"
                @click:append="show = !show"
              ></v-text-field>

              <v-radio-group v-model="gender" row>
                <v-radio label="Male" color="#44c7f5" value="Male"></v-radio>
                <v-radio
                  label="Female"
                  color="#44c7f5"
                  value="Female"
                ></v-radio>
              </v-radio-group>

              <v-btn
                @click="signUpThree"
                :disabled="btn_signin_disabled"
                color="cyan white--text mt-3 rounded"
                width="100%"
                ><button type="submit">Sign up</button></v-btn
              >
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
  emits: ["login"],
  data() {
    return {
      btn_signin_disabled: true,
      phone: "",
      id: "",
      oldUser: "",
      allProvinces: [],
      dateofbirth: "",
      province: "",
      email: "",
      password: "",
      gender: "",
      email_err: "",
      activePicker: null,
      date: null,
      menu: false,
      show: false,
      phoneErr: [(v) => !!v || "Phone is required"],
      rules: {
        required: (value) => !!value || "Password is required.",
      },
      rulesphone: {
        required: (value) => !!value || "Required.",
        min: (v) =>
          (v.length >= 9) ||
          "should be the real phone number",
      },

      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
    };
  },
  watch: {
    phone() {
      if (
        this.phone !== "" &&
        this.dateofbirth !== "" &&
        this.province !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.email !== ""
      ) {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
    dateofbirth() {
      if (
        this.phone !== "" &&
        this.dateofbirth !== "" &&
        this.province !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.email !== ""
      ) {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
    province() {
      if (
        this.phone !== "" &&
        this.dateofbirth !== "" &&
        this.province !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.email !== ""
      ) {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
    password() {
      if (
        this.phone !== "" &&
        this.dateofbirth !== "" &&
        this.province !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.email !== ""
      ) {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
    gender() {
      if (
        this.phone !== "" &&
        this.dateofbirth !== "" &&
        this.province !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.email !== ""
      ) {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
    email() {
      if (
        this.phone !== "" &&
        this.dateofbirth !== "" &&
        this.province !== "" &&
        this.password !== "" &&
        this.gender !== "" &&
        this.email !== ""
      ) {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
      this.email_err = "";
    },
    menu(val) {
      val && setTimeout(() => (this.activePicker = "YEAR"));
    },
  },

  methods: {
    save(date) {
      this.$refs.menu.save(date);
    },

    signUpThree() {
      let user = JSON.parse(localStorage.getItem("user"));
      let name = user.name.split(" ");
      let userCreate = new FormData();
      userCreate.append("first_name", name[0]);
      userCreate.append("last_name", name[1]);
      userCreate.append("role", "ALUMNI");
      userCreate.append("email", this.email);
      userCreate.append("password", this.password);
      axios
        .post("/signup", userCreate)
        .then((res) => {
          this.oldUser = res.data.user;
          localStorage.setItem("id", res.data.user.id);
          localStorage.setItem("role", res.data.user.role.toUpperCase());
          let userDetail = new FormData();
          userDetail.append("user_id", localStorage.getItem("id"));
          userDetail.append("phone", this.phone);
          userDetail.append("date_of_birth", this.dateofbirth);
          userDetail.append("province", this.province);
          userDetail.append("batch", user.batch);
          userDetail.append("major", user.major);
          // userDetail.append('picture',null);
          userDetail.append("current_position", "NONE");
          userDetail.append("gender", this.gender);
          axios.post("/user_details", userDetail).then((res) => {
            localStorage.setItem("user", JSON.stringify(this.oldUser));
            localStorage.setItem("login", true);
            localStorage.setItem("userDetail", JSON.stringify(res.data.data));
            this.$emit("login", true);
            this.$router.push("/profile-view");
          });
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.email_err = err.response.data.errors.email[0];
          }
        });
    },
  },
  mounted() {
    axios.get("/countries").then((res) => {
      for (let province of res.data) {
        this.allProvinces.push(province.name);
      }
    });
  },
};
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