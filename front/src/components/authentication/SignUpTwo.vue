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
          <form action="" class="mb-10">
          <h1 class="one text-center">Sign Up Account</h1>
          <p>
            <label for>
              Please input your PNC Batch
              <span class="red--text">*</span>
            </label>
            <input type="text" placeholder="PNC Batch ..." required />
          </p>
          <p>
            <label for>
              Please input your PNC Major
              <span class="red--text">*</span>
            </label>
            <input type="text" placeholder="PNC Major ..." required />
          </p>
          <p>
            <router-link to="/signupthree">
              <input class="next" type="submit" value="Next" />
            </router-link>
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
    return {};
  }
};
</script>


<style scoped>
.one {
  margin-bottom: 20px;
}
.form {
  margin-top: 50px;
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
</style>