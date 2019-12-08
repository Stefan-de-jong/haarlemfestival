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
    <input disabled type="text" name="id" value="<?php echo $data->id;?>"></input><br>
    <input disabled type="text" name="fn" value="<?php echo $data->firstname;?>"></input><br>
    <input disabled type="text" name="ln" value="<?php echo $data->lastname;?>"></input><br>
    <input disabled type="text" name="em" value="<?php echo $data->email;?>"></input><br>
    <input disabled type="text" name="role" value="<?php echo $data->role;?>"></input><br>
    <input type="submit" value="update">
</form>
</div>
<?php if ($_SESSION["cms_role"]=="ADMIN" || $_SESSION["cms_role"]=="SUPERADMIN"){?>
    <script>
        for(i=1;i<document.getElementsByTagName("input").length;i++){
            document.getElementsByTagName("input")[i].disabled=false;
        }
    </script>
<?php } ?>
</body>

</html>