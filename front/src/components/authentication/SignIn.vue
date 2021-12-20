<template>
    <div class="wrapper login">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h1>Welcome</h1>
                    <img src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png" alt="logo PNC" id="logo">
                    <router-link to="/signup" class="btn">Sign Up</router-link>
                </div>
            </div>

            <div class="col-right">
                <div class="login-form">
                    <h1>Sign in account</h1>
                    <form action="#" @submit.prevent>
                        <p>
                            <label>Email Address<span>*</span></label>
                            <input type="text" placeholder="Email Address" v-model="email" required>
                        </p>
                        <p>
                            <label>Password<span>*</span></label>
                            <input type="password" placeholder="Password" v-model="password" minlength="8" required>
                        </p>
                        <p v-if="messageAlert != ''">
                            <label for="#">{{messageAlert}}</label>
                        </p>
                        <p>
                            <input type="submit" value="Sign In" @click="signIn">
                        </p>
                        <p>
                            <a href="">Forget password?</a>
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import axios from "@/router/index.js";
  export default {
      data() {
          return {
             messageAlert : '',
             email : "",
             password : "",
          }
      },
      methods: {
        signIn(){
            let user = new FormData();
            user.append("email",this.email);
            user.append("password",this.password);
            axios.post('/signin',user).then(res=>{
                if(res.data == 'Invalid email or password'){
                    this.messageAlert = res.data  
                }else {
                    this.$router.push('/home');
                }
            })
        }
    },
}
</script>


<style scoped>

*{
    box-sizing: border-box;
}
body{
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #444444;
    background: #eaeff4;
}

.wrapper{
    margin: 0 auto;
    width: 100%;
    max-width: 1140px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.container{
    position: relative;
    width: 100%;
    max-width: 600px;
    max-height: 320px;
    height: auto;
    display: flex;
    background: #ffffff;
    box-shadow: 0 0 5px #999999;
}
.login .col-left,
.login .col-right{
    padding: 30px;
    display: flex;
}
.login .col-left{
    width: 60%;
    clip-path: polygon(0 0, 0% 100%, 90% 0 );
    background: #44c7f5;
}
.login .col-right{
    padding: 60px 30px;
    width: 50%;
    margin-left: -10%;
}
.login .login-text{
    position: relative;
    width: 100%;
    color: #ffffff;
    margin-top: 18px;
    margin-top: -10px;
}
.login .login-text h2{
    margin: 0 0 15px 0;
    font-size: 30px;
    font-weight: 700;
}
.login .login-text p{
    margin: 0 0 20px 0;
    font-size: 16px;
    font-weight: 500;
    line-height: 22px;
}
.btnSub,
.login .login-text .btn{
    display: inline-block;
    padding: 7px 20px;
    font-size: 16px;
    letter-spacing: 1px;
    margin-top: 10px;
    width: 17vh;
    text-decoration: none;
    border-radius: 30px;
    color: #ffffff;
    outline: none;
    display: block;
    border: 1px solid #ffffff;
    box-shadow: inset 0 0 0 0 #ffffff;
    transition: .3s;
}
.login .login-text .btn:hover{
    color: #44c7f5;
    box-shadow: inset 150px 0 0 0  #ffffff;
}
.login .login-form{
    position: relative;
    width: 100%;
    margin-top: -40px;
}
.login .login-form h2{
    margin: 0 0 15px 0;
    font-size: 22px;
    font-weight: 700;
}
.login .login-form p{
    margin: 0 0 10px 0;
    text-align: left;
    color: #666666;
    font-size: 15px;
}
.login .login-form p:last-child{
    margin: 0;
    padding-top: 3px;
}
.login .login-form p a{
    color: #44c7f5;
    font-size: 14px;
    text-decoration: none;
}
.login .login-form label {
    display: block;
    width: 100%;
    margin-bottom: 2px;
    letter-spacing: .5px;
}
.login .login-form p:last-child label{
    width: 60%;
    float: left;
}
.login .login-form label span{
    color: #ff574e;
    padding-left: 2px;
}
.login .login-form input{
    display: block;
    width: 100%;
    height: 35px;
    padding: 0 10px;
    outline: none;
    border: 1px solid #cccccc;
    border-radius: 30px;
}
.login .login-form button:hover,
.login .login-form input[type=submit]:hover{
    color: #ffffff;
    box-shadow: inset 250px 0 0 0 #44c7f5;
}
#logo{
  width: 13vh;
  height: 13vh;
}
img{
    margin-top: 15px;
}
.btn{
    margin-left: -25px;
}
@media(max-width: 575px){
    .login .container{
        flex-direction: column;
        box-shadow: none;
        padding: 100px;   
    }
    .login .col-left,
    .login .col-right{
     width: 100%;
     margin: 0;
     clip-path: none;
    }
    .login .col-right{
        padding: 60px;
    }   
}

</style>
