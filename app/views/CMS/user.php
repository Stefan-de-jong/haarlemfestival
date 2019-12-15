<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/CMS/CMS_Content.css">
<title>Website Content Manager</title>
</head>
<body>
<a href="<?php echo URLROOT."/CMS/home";?>"><button class="backbutton"><- Back</button></a>
<div class="content">
    <form action="<?php echo URLROOT."/CMS/user";?>" method="POST">
    <input readonly type="text" name="id" value="<?php echo $data->id;?>"></input><br>
    <input readonly type="text" name="fn" value="<?php echo $data->firstname;?>"></input><br>
    <input readonly type="text" name="ln" value="<?php echo $data->lastname;?>"></input><br>
    <input readonly  type="text" name="em" value="<?php echo $data->email;?>"></input><br>
    <div id="dropdown"><select name="role">
  <option  value="USER">USER</option>
  <option  value="ADMIN">ADMIN</option>
  <option  value="SUPERADMIN">SUPERADMIN</option>
</select></div><br>
<?php
if ($_SESSION["cms_role"]=="ADMIN" || $_SESSION["cms_role"]=="SUPERADMIN"){?>
    <input type="submit" value="update">
<?php }?>
</form>
</div>

<script>
document.getElementsByTagName("option")[{"USER":0,"ADMIN":1,"SUPERADMIN":2}["<?php echo $data->role;?>"]].selected=true;
</script>
<?php 
if ($_SESSION["cms_role"]=="ADMIN" || $_SESSION["cms_role"]=="SUPERADMIN"){?>
    <script>
        for(i=1;i<document.getElementsByTagName("input").length;i++){
            document.getElementsByTagName("input")[i].readOnly=false;
        }
    </script>
<?php }
if (!($_SESSION["cms_role"]=="SUPERADMIN")){?>
<script>
            document.getElementById("dropdown").innerHTML="";
</script>
<?php } ?>
</body>

</html>