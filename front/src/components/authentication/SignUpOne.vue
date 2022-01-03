<template>
  <div>
    <Base-form>
      <router-link to="/signin" class="btn">Sign In</router-link>
      <template #signup>
        <div class="form">
          <form  class="mb-10" @submit.prevent>
            <h1 class="one text-center">Sign Up Account</h1>
            <p class="mt-5">
              <label >
                Please input your first name
                <span class="red--text">*</span>
              </label>
              <v-text-field
                v-model="first_name"
                label="First name"
                :rules="[rules.required]"
                hide-details="auto"
                outlined
                class="mt-3 rounded-pill"
                dense
              ></v-text-field>
            </p>
            <p class="mt-5">
              <label for>
                Please input your last name
                <span class="red--text">*</span>
              </label>
              <v-text-field
                outlined
                dense
                :rules="[rules.required]"
                hide-details="auto"
                v-model="last_name"
                label="Last name"
                class="mt-3 rounded-pill"
              ></v-text-field>
            </p>
            <p>
              
              <v-btn
                @click="signup_one"
                color="cyan white--text mt-3 rounded-pill" width="100%"
              ><button type="submit">Next</button></v-btn>
            </p>
          </form>
        </div>
      </template>
    </Base-form>
  </div>
</template>
<script>
import axios from "@/api/api.js";
export default {
  data() {
    return {
      rules: {
        required: (value) => !!value || "Required.",
      },

      name: "",
      success: false,
      first_name: "",
      last_name: "",
    };
  },
  methods: {
    signup_one() {
      let name = this.last_name + " " + this.first_name;
      if(this.first_name !== "" && this.last_name !== ""){
        for (let alu of this.name) {
          if (alu.name !== undefined) {
            if (alu.name.toLowerCase() === name.toLowerCase()) {
              this.success = true;
              localStorage.setItem("user", JSON.stringify(alu));
            }
          }
        }
        if (this.success == true) {
          this.$router.push("/signuptwo");
        } else {
          this.$router.push("/warning");
        }
      }
    },
  },
  mounted() {
    localStorage.clear();
    localStorage.setItem("path", "/signupone");
    axios.get("/alumini").then((res) => {
      this.name = res.data;
    });
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