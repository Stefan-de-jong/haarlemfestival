<?php
require_once(APPROOT."/helpers/url_helper.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/CMS/CMS_Home.css">
</head>

<body>
Welcome, <b><?php echo $_SESSION["cms_fn"];?></b>
<div class="content">
<a href="<?php echo URLROOT."/CMS/content" ?>"><button class="btn"><i class="fa fa-bars"></i> Website Content</button></a><br>
<button class="btn"><i class="fa fa-bars"></i> Search Users</button><br>
<a href="<?php echo URLROOT."/CMS/users"?>"><button class="btn"><i class="fa fa-bars"></i> Manage Users</button></a><br>
<button class="btn"><i class="fa fa-bars"></i> Reservations</button><br>
<button class="btn"><i class="fa fa-bars"></i> Media Manager</button><br>
<button class="btn"><i class="fa fa-bars"></i> Event Manager</button><br>
<button class="btn"><i class="fa fa-bars"></i> Ticket Scan</button><br>
<button class="btn"><i class="fa fa-bars"></i> Ticket Sell</button><br>
<form action="<?php echo URLROOT;?>/CMS/logout" method="post">
<button class="btn"><i class="fa fa-bars"></i> Logout</button><br>
</form>
</div>
</body>

</html>