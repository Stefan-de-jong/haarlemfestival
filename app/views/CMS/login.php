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
<form action="<?php echo URLROOT;?>/CMS/login" method="post">
<input type="text" placeholder="Email" name="email"></input><br>
<input type="password" name="password"></input><br>
<input type="hidden" name="shouldLogin" value="true"></input>
<input type="submit"></input>
</form>
</div>

</div>
</body>

</html>