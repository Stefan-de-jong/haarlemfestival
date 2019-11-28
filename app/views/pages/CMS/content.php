<?php
require_once(APPROOT."/models/Page.php");
require_once(APPROOT."/models/PageRepository.php");
$repo=new PageRepository();

if (isset($_POST["newHtml"])){
  $newpage = new Page(1,"page1",$_POST["newHtml"]);
  $success = $repo->update($newpage);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/CMS/CMS_Content.css">
<title>Website Content Manager</title>
</head>

<body>
<div class="navbar">
  <a id="n1" class="active">Home</a>
  <a id="n2" >Jazz</a>
  <a id="n3" >Dance</a>
  <a id="n4" >Food</a>
  <a id="n5" >Historic</a>
</div>
<script>
var navbaritems=[];
for (i=1;i<=5;i++){
var navbaritem=document.getElementById("n"+i);
navbaritems.push(navbaritem);
navbaritem.addEventListener("click",function(e){
clearActives();
event.target.className="active";
})
};
function clearActives(){
    navbaritems.forEach(function(n){
        n.className="";
    });
}
</script>
<div class="content">
<script src="https://cdn.tiny.cloud/1/7a6z415bc5uf8mx9kms9qodrcmq4q1r5qsf0qs50kb4brv2o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea',init_instance_callback : function(editor){
     
  }});</script>
  <form method="post" action="<?php echo URLROOT."/pages/CMScontent"; ?>">
  <textarea id="t1" name="newHtml"><?php echo $repo->findId(1)->html; ?></textarea>
  <input type="submit"></input>
</form>
</div>
</body>

</html>