<?php
require_once(APPROOT."/models/User.php");
require_once(APPROOT."/models/UserRepository.php");
if (!isset($_POST["shouldLogin"])){
    //niet inloggen, standaard pagina laten zien
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CMS</title>
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/CMS.css">
</head>

<body>
<div class="login-area">
<div class="login-form">
<form action="CMS/index.php"method="POST">
<input type="text" placeholder="Email" name="email"></input><br>
<input type="password" name="password"></input><br>
<input type="hidden" name="shouldLogin" value="true"></input>
<input type="submit"></input>
</form>
</div>

</div>
</body>

</html>
<?php
    }else{
        $repo = new UserRepository();
        try {
            $u = $repo->login($_POST["email"],$_POST["password"]);
            echo "yeah";
        }catch(Exception $e){
            echo "nah";
        }
    }

?>