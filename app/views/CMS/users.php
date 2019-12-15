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
  <form method="POST" action="<?php echo URLROOT."/CMS/users"; ?>">
  <input type="text" id="c1" name="id" placeholder="User ID"></input><input type="checkbox" checked class="include" name="c1">Include in search</input><br>
  <input type="text" id="c2"  name="fn" placeholder="First Name"></input><input type="checkbox" checked class="include" name="c2">Include in search</input><br>
  <input type="text" id="c3" name="ln" placeholder="Last Name"></input><input type="checkbox" checked class="include" name="c3">Include in search</input><br>
  <input type="submit" value="Search"></input>
</form>
<script>
  var bindings={"c1":"id","c2":"fn","c3":"ln"};
var checkboxes = document.getElementsByClassName("include");
for(i=0;i<checkboxes.length;i++) {
  var checkbox=checkboxes[i];
  checkbox.addEventListener('change', function(e) {
    if(this.checked) {
        document.getElementById(this.name).name=bindings[this.name];
    } else {
      document.getElementById(this.name).name="NOTSET";
    }
});
}
</script>
<?php if ($data!=null){ ?>
<table>
  <caption>Results</caption>
  <tr>
  <td><b>ID</b></td>
    <td><b>First Name</b></td>
    <td><b>Last Name</b></td>
    <td><b>Email</b></td>
    <td><b>Role</b></td>
    <td><b>Options</b></td>
  </tr>
  <?php
  foreach($data as $user){
    $id = $user->id;
    $actionview = URLROOT."/CMS/user";
    $actiondelete = URLROOT."/CMS/deleteuser/";
    $viewbuttontext = ($_SESSION["cms_role"]=="ADMIN"||$_SESSION["cms_role"]=="SUPERADMIN" ? "View/Edit" : "View");
    $isNonuser = $_SESSION["cms_role"]=="ADMIN"||$_SESSION["cms_role"]=="SUPERADMIN";

    $html=
    "<tr><td>$user->id</td>
    <td>$user->first_name</td>
    <td>$user->last_name</td>
    <td>$user->email</td>
    <td>$user->role</td>
    <td><form action='$actionview' method='GET'>
    <input type='hidden' name='id' value='$id'></input>
    <input type='submit' value='$viewbuttontext'</input></form>";

    if ($isNonuser){
      $html.="<form action='$actiondelete' method='POST'><input type='hidden' name='id' value='$id'></input>
      <input type='submit' value='Delete'></input></form>";
    }
    $html.="</form></td></tr>";
  echo $html;
  }
  ?>
</table>
<?php }?>
</div>
</body>

</html>