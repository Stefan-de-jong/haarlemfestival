<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS</title>
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/CMS/CMS.css">
</head>

<body>
<div class="login-area">
    <div class="logo">
        <img src="http://localhost/haarlemfestival/img/logo.png"></img>
</div>
<div class="login-form">
<form id="loginform" action="<?php echo URLROOT;?>/CMS/login" method="post">
<input type="text" placeholder="Email" name="email"></input><br>
<input type="password" name="password"></input><br>
<input type="hidden" name="shouldLogin" value="true"></input>
<input type="submit"></input>
</form><br><br><br>DEVELOPMENT QUICKLOGIN
<input type="button" id="1" value="LOGIN USER (ELLEN)"></input>
<input type="button" id="2" value="LOGIN ADMIN (THIJS)"></input>
<input type="button" id="3" value="LOGIN SUPERADMIN (TOM)"></input>
<script>
document.getElementById("1").addEventListener("click",function(){
document.getElementsByName("email")[0].value="ellen@leen.com";
document.getElementsByName("password")[0].value="test";
document.getElementById("loginform").submit();
});
document.getElementById("2").addEventListener("click",function(){
document.getElementsByName("email")[0].value="thijs@otter.com";
document.getElementsByName("password")[0].value="test";
document.getElementById("loginform").submit();
});
document.getElementById("3").addEventListener("click",function(){
document.getElementsByName("email")[0].value="tom@bo.com";
document.getElementsByName("password")[0].value="test";
document.getElementById("loginform").submit();
});
</script>
</div>

</div>
</body>

</html>