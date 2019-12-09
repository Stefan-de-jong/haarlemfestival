<?php
require_once(APPROOT."/models/Page.php");
require_once(APPROOT."/models/PageRepository.php");
$repo=new PageRepository();

if (isset($_POST["newHtml"])){
  $newpage = new Page($_POST["id"],$_POST["newTitle"],$_POST["newHtml"]);
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
<a href="<?php echo URLROOT."/CMS/home";?>"><button class="backbutton"><- Back</button></a>
<div class="content">
<div class="navbar">
  <a id="n1" class="active">Home</a>
  <a id="n2" >Jazz</a>
  <a id="n3" >Dance</a>
  <a id="n4" >Food</a>
  <a id="n5" >Historic</a>
</div>
<script>
var htmls = [];
<?php
$pagesDB = $repo->findAll();
foreach($pagesDB as $pageDB){
$page = new Page($pageDB->id,$pageDB->title,json_encode($pageDB->html));
echo "htmls.push({id: '$page->id',title: '$page->title',html: $page->html});";
}
?>
var navbaritems=[];
for (i=1;i<=5;i++){
var navbaritem=document.getElementById("n"+i);
navbaritems.push(navbaritem);
navbaritem.addEventListener("click",function(e){
clearActives();
event.target.className="active";
setEditorPage(navbaritems.indexOf(event.target));
})
};
function clearActives(){
    navbaritems.forEach(function(n){
        n.className="";
    });
}
</script>
<script src="https://cdn.tiny.cloud/1/7a6z415bc5uf8mx9kms9qodrcmq4q1r5qsf0qs50kb4brv2o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'.editor',init_instance_callback : function(editor){
     
  },
  valid_elements : '*[*]'});</script>
  <script>
  function setEditorPage(index){
      tinyMCE.activeEditor.setContent(htmls[index].html);
      document.getElementById("titleField").value=htmls[index].title;
      document.getElementById("idField").value=htmls[index].id;
  };
  </script>
  <form method="post" action="<?php echo URLROOT."/pages/CMS_content"; ?>">
  <input type="hidden" name="id" id="idField"></input>
  <input type="text" id="titleField" name="newTitle"></input>
  <textarea class="editor" name="newHtml"></textarea>
  <input type="submit" value="Update"></input>
</form>
</div>
</body>

</html>