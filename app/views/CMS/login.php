<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS</title>
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/CMS/CMS.css">
</head>

<body>
<div class="center">
    <div class="logo">
        <img src="http://localhost/haarlemfestival/img/logo.png"></img>
</div>
<div>
<form action="<?php echo URLROOT;?>/CMS/login" method="post">
<input type="text" value="tom@bo.comm" placeholder="Email" name="email"></input><br>
<input type="password" value="test" name="password"></input><br>
<input type="hidden" name="shouldLogin" value="true"></input>
<input type="submit"></input>
</form>
</div>

</div>
</body>

</html>