<template>
     
     <div class="wrapper login">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h1>Welcome</h1>
                    <img src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png" alt="logo PNC" id="logo">
                    <a href="" class="btn">Sign In</a>
                </div>
            </div>

            <div class="col-right">
                <div class="login-form">
                    <h1 class="one">Sign Up Account</h1>
                    <form action="">
                        <p>
                            <input type="text" placeholder="First name ..." required>
                        </p>
                        <p>
                            <input type="text" placeholder="Last name ..." required>
                        </p>
                        <p>
                            <input type="text" placeholder="Batch ..." required>
                        </p>
                        <p>
                            <router-link to="/signuptwo" class="next">
                               <input type="submit" value="Next">
                            </router-link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</template>



<script>
</script>



<style scoped>

*{
    box-sizing: border-box;
}
.wrapper{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.container{
    max-width: 650px;
    height: 300px;
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
    background: #44C7F5;
}
.login .col-right{
    padding: 60px 30px;
    width: 50%;
    margin-left: -10%;
}
.login .login-text{
    color: #ffffff;
    margin-top: -20px;
}
.login .login-text .btn{
    display: inline-block;
    padding: 7px 20px;
    font-size: 16px;
    letter-spacing: 1px;
    text-decoration: none;
    border-radius: 30px;
    color: #ffffff;
    outline: none;
    border: 1px solid #ffffff;
    box-shadow: inset 0 0 0 0 #ffffff;
    transition: .3s;
    margin-right: 500px;
}
.login .login-text .btn:hover{
    color: #44C7F5;
    box-shadow: inset 150px 0 0 0  #ffffff;
}
.login .login-form input[type="text"],
.login .login-form input[type="password"],
.login .login-form input[type="number"],
.login .login-form input{
    display: block;
    width: 100%;
    height: 35px;
    padding: 0 10px;
    margin-top: 10px;
    outline: none;
    border: 1px solid #3b3b3bd3;
    border-radius: 30px;
}
.login .login-form button:hover,
.login .login-form input[type=submit]:hover{
    color: #ffffff;
    box-shadow: inset 250px 0 0 0 #44C7F5;
    margin-top: 20px;
}
img{
    height: 100px;
}
.btn{
    margin-top: 15px;
    width: 18%;
    margin-left: -27px;
    text-align: center;
}
.one{
    margin-top: -50px;
}
#selectgen {
    display: flex;
    width: 100%;
}
#selectgen input[type="radio"]{
    width: 18px;
    height: 18px;
    margin-top: 0.75px;
    margin-left: 20px;
    margin-right: 20px;
}
#gender{
    display: flex;
}
.next{
    text-decoration: none;
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
