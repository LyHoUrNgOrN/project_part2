<template>
  <Base-form>
    <router-link to="/signin" class="btn">Sign In</router-link>
    <template #signup>
      <div class="form">
        <form action="#" class="mb-10">
          <h1 class="one text-center">Sign Up Account</h1>
          <p>
            <label for>
              Please input your first name
              <span class="red--text">*</span>
            </label>
            <input type="text" placeholder="First name ..." required />
          </p>
          <p>
            <label for>
              Please input your last name
              <span class="red--text">*</span>
            </label>
            <input type="text" placeholder="Last name ..." required />
          </p>
          <p>
            <router-link to="/signuptwo">
              <input class="next" type="submit" value="Next" />
            </router-link>
          </p>
        </form>
      </div>
    </template>
  </Base-form>
</template>
<script>
export default {};
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