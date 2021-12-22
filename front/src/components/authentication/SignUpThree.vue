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
          <form action>
            <h1 class="one text-center mt-3">Sign Up Account</h1>
            <p>
              <input type="text" placeholder="Phone ..." required />
            </p>
            <p>
              <input type="text" placeholder="Date of Birth ..." required />
            </p>

            <p>
              <v-select :items="provinces" label=" Select Province " class="select" dense outlined></v-select>
            </p>

            <div class="formall">
              <p>
                <input type="text" class="email" placeholder="Email ..." required />
              </p>
              <p>
                <input type="text" placeholder="Password ..." required />
              </p>
              <p>
                <input type="text" placeholder="Current Position ..." required />
              </p>
              <div class="gender">
                <div class="d-flex">
                  <span class="mt-7 me-5">Gender:</span>
                  <v-radio-group>
                    <div class="d-flex">
                      <v-radio label="Male" class="mt-2 me-3" color="#44c7f5" value="Male"></v-radio>
                      <v-radio label="Female" color="#44c7f5" value="Female"></v-radio>
                    </div>
                  </v-radio-group>
                </div>
              </div>
              <p>
                <router-link to="/profile-view">
                  <input class="next" type="submit" value="Sign Up" />
                </router-link>
              </p>
            </div>
          </form>
        </div>
      </template>
    </Base-form>
  </div>
</template>



<script>
import province from "@/files/canbodia.json";

export default {
  data() {
    return {
      provinces: []
    };
  },
  methods: {},
  mounted() {
    for (let pro of province) {
      this.provinces.push(pro.name);
    }
  }
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