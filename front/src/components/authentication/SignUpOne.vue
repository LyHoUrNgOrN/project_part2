<template>
  <div>
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
              <input
                v-model="first_name"
                type="text"
                placeholder="First name ..."
                required
              />
              <!-- <small v-if="emailError != ''" style="color : red">{{emailError}}</small> -->
            </p>
            <p>
              <label for>
                Please input your last name
                <span class="red--text">*</span>
              </label>
              <input
                v-model="last_name"
                type="text"
                placeholder="Last name ..."
                required
              />
            </p>
            <p>
              <input
                @click="signup_one"
                class="next"
                type="submit"
                value="Next"
              />
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
      name: "",
      success: false,
      first_name: "",
      last_name: "",
    };
  },
  methods: {
    signup_one() {
      let name = this.first_name + " " + this.last_name;
      name = name.toLowerCase().trim();
      for (let alu of this.name) {
        if (alu.name.toLowerCase() == name && alu.name != undefined) {
          this.success = true;
          localStorage.setItem("user", JSON.stringify(alu));
        }
      }
      if (this.success == true) {
        this.$router.push("/signuptwo");
      } else {
        this.$router.push("/warning");
      }
    },
  },
  mounted() {
    localStorage.clear();
    localStorage.setItem('path','/signupone');
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