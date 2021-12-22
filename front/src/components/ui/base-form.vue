<template>
  <div class="wrapper login">
    <div class="container">
      <div class="col-left">
        <div class="login-text">
          <slot name="back"></slot>
          <h1 class="mt-3">Welcome</h1>
          <img
            src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
            alt="logo PNC"
            id="logo"
            width="90"
            class="mb-2"
          />
          <slot ></slot>
        </div>
      </div>

      <div class="col-right">
        <div class="login-form">
          <section action>
            <slot name="signup"></slot>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
</script>



<style scoped>
* {
  box-sizing: border-box;
}
.wrapper {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.container {
  width: 50%;
  display: flex;
  background: #ffffff;
  box-shadow: 0 0 5px #999999;
}

.login .col-left {
  width: 55%;
  clip-path: polygon(0 0, 0% 100%, 90% 0);
  background: #44c7f5;
}
.col-right {
    width: 45%;
    padding-right: 20px;
}
.login-text {
  color: #fff;
  padding: 20px;
  margin-left: 10px;
  position: relative;
}

.btn {
  padding: 5px;
  text-align: center;
  border-radius: 40px;
  width: 100px;
  position: absolute;
  left: -5px;
  top: 100%;
  letter-spacing: 1px;
  text-decoration: none;
  color: #ffffff;
  border: 1px solid #ffffff;
  box-shadow: inset 0 0 0 0 #ffffff;
  transition: 0.3s;
}
.btn:hover {
  color: #44c7f5;
  box-shadow: inset 150px 0 0 0 #ffffff;
}
section input {
    width: 100%;
    border: 1px solid #44c7f5;
    padding: 5px 5px 5px 15px;
    border-radius: 40px;
}
@media(max-width: 575px){
   .container{
       width: 500px;
   }  
}

</style>
