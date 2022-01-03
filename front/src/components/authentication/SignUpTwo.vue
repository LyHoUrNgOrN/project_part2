<template>
  <div>
    <Base-form>
      <template #back>
        <router-link to="/signupone">
          <a href class="btn">&#x2B05;Back</a>
        </router-link>
      </template>
      <router-link to="/signin" class="btn signin">Sign In</router-link>
      <template #signup>
        <div class="form">
          <form class="mb-10">
            <h1 class="one text-center">Sign Up Account</h1>
            <p>
              <label for>
                Please input your PNC Batch
                <span class="red--text">*</span>
              </label>
              <v-text-field
                v-model="batch"
                label="PNC Batch"
                :rules="[rules.required]"
                hide-details="auto"
                outlined
                class="mt-3 rounded-pill"
                dense
              ></v-text-field>
            </p>
            <p class="mt-5">
              <label for>
                Please input your PNC Major
                <span class="red--text">*</span>
              </label>
              <v-select
                :items="items"
                label="PNC Major"
                dense
                class="rounded-pill mt-2"
                outlined
                v-model="major"
              ></v-select>
            </p>
            <p>
              <v-btn
                @click="signupTwo"
                :disabled="btn_signin_disabled"
                color="cyan white--text rounded"
                width="100%"
                ><button type="sumbit">Next</button></v-btn
              >
            </p>
          </form>
        </div>
      </template>
    </Base-form>
  </div>
</template>


<script>
export default {
  data() {
    return {
      btn_signin_disabled: true,
      major: "",
      batch: "",
      items: ["WEP", "SNA"],
      rules: {
        required: (value) => !!value || "Required.",
      },
    };
  },
  watch: {
    major() {
      if (this.major !== "" && this.batch !== "") {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
    batch() {
      if (this.major !== "" && this.batch !== "") {
        this.btn_signin_disabled = false;
      } else {
        this.btn_signin_disabled = true;
      }
    },
  },

  methods: {
    signupTwo() {
      let user = JSON.parse(localStorage.getItem("user"));
      if (user.batch == this.batch) {
        this.$router.push("/signupthree");
        user.major = this.major;
        localStorage.setItem("user", JSON.stringify(user));
      } else {
        localStorage.setItem("path", "/signuptwo");
        this.$router.push("/warning");
      }
    },
  },
};
</script>


<style scoped>
.one {
  margin-bottom: 20px;
}
.form {
  margin-top: 50px;
}
.selectMarjor {
  width: 100%;
  border: 1px solid #44c7f5;
  padding: 5px;
  border-radius: 5px;
  color: #626566;
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
  /* right: -100%; */
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
p input {
  margin-top: 10px;
}
.selectMarjor {
  border-radius: 30px;
}
</style>