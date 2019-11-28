<?php
var_dump($_POST);
require_once(APPROOT."/models/Page.php");
require_once(APPROOT."/models/PageRepository.php");
$repo=new PageRepository();
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
  <a id="n1" class="active">1</a>
  <a id="n2" >2</a>
  <a id="n3" >3</a>
  <a id="n4" >4</a>
  <a id="n5" >5</a>
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
  <form method="post" action="CMS/CMScontent">
  <textarea id="t1" name="t2"><?php echo $repo->findId(1)->html; ?></textarea>
  <input type="submit"></input>
</form>
</div>
</body>

</html>