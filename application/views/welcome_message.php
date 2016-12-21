<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
          width: 360px;
          padding: 8% 0 0;
          margin: auto;
        }
        .form {
          position: relative;
          z-index: 1;
          background: #FFFFFF;
          max-width: 360px;
          margin: 0 auto 100px;
          padding: 45px;
          text-align: center;
          box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input {
          font-family: "Roboto", sans-serif;
          outline: 0;
          background: #f2f2f2;
          width: 100%;
          border: 0;
          margin: 0 0 15px;
          padding: 15px;
          box-sizing: border-box;
          font-size: 14px;
        }
        .form .button {
          font-family: "Roboto", sans-serif;
          text-transform: uppercase;
          outline: 0;
          background: #7266ba;
          width: 100%;
          border: 0;
          padding: 15px;
          color: #FFFFFF;
          font-size: 14px;
          -webkit-transition: all 0.3 ease;
          transition: all 0.3 ease;
          cursor: pointer;
        }
        .form .button:hover,.form .button:active,.form .button:focus {
          background: #4d3eab;
        }
        .form .message {
          margin: 15px 0 0;
          color: #283744;
          font-size: 12px;
        }
        .form .message a {
          color: #283744;
          font-weight: 600;
          text-decoration: none;
        }
        .form .register-form {
          display: none;
        }
        .container {
          position: relative;
          z-index: 1;
          max-width: 300px;
          margin: 0 auto;
        }
        .container:before, .container:after {
          content: "";
          display: block;
          clear: both;
        }
        .container .info {
          margin: 50px auto;
          text-align: center;
        }
        .container .info h1 {
          margin: 0 0 15px;
          padding: 0;
          font-size: 36px;
          font-weight: 300;
          color: #1a1a1a;
        }
        .container .info span {
          color: #4d4d4d;
          font-size: 12px;
        }
        .container .info span a {
          color: #000000;
          text-decoration: none;
        }
        .container .info span .fa {
          color: #EF3B3A;
        }
        body {
          background: #f0f3f4; /* fallback for old browsers */
          background: -webkit-linear-gradient(right, #f0f3f4, #f0f3f4);
          background: -moz-linear-gradient(right, #f0f3f4, #f0f3f4);
          background: -o-linear-gradient(right, #f0f3f4, #f0f3f4);
          background: linear-gradient(to left, #f0f3f4, #f0f3f4);
          font-family: "Roboto", sans-serif;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;      
        }
    </style>
</head>
<body>
    <div class="login-page">
      <div class="form">
        <form class="register-form" id="registerForm">
          <input type="text" name="firstName" id="firstName" placeholder="First Name"/>
          <input type="text" name="lastName" id="lastName" placeholder="Last Name"/>
          <input type="text" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number"/>
          <input type="text" name="emailId" id="emailId" placeholder="Email Id"/>
          <input type="password" name="password" id="password" placeholder="Password"/>
          <input type='button' class='button' id="createBtnInWelcome" value='Create' />
          <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form class="login-form" id="loginForm" action='' method='post' name='process'>
          <input type="text" name='username' id='username' placeholder="username" 
            value="" />
          <input type="password" name='password' id='password' placeholder="password" 
            value="" />
          <input type='button' class='button' id="loginBtnInWelcome" value='Login' />
          <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
        <span id="ajax-panel"> </span>
      </div>
    </div>
</body>

<script src="<?php echo base_url().'assets/'?>js/jquery.min.js" type="text/javascript"></script>


<script type="text/javascript">
    $('.message a').click(function(){
       $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
       $('#ajax-panel').empty();
    });
</script>
<!--welcome controller js -->
<script src="<?php echo base_url().'/assets/'?>js/main/welcome.js" type="text/javascript"></script>

</html>