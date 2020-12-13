<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<?php
$snippets = $data['data'];
$snippetsDance = $snippets["dance"];
$snippetsHistoric1 = $snippets['historicMain'];
$snippetsHistoric2 = $snippets['historicRoute'];
$snippetsFood1 = $snippets['foodMain'];
$snippetsFood2 = $snippets['foodRestaurants'];
if (isset($data['Message'])){
    echo $data['Message'];
}
?>
<div class="tab">
    <button id="Start" class="tablinks" onclick="openTab(event,'Dance')">Dance</button>
    <button class="tablinks" onclick="openTab(event,'Historic')">Historic</button>
    <button class="tablinks" onclick="openTab(event,'Food')">Food</button>
</div>

<div id="Dance" class="tabcontent">
    <?php echoEditors("Dance",$snippetsDance); ?>
</div>

<div id="Historic" class="tabcontent">
     <?php echoEditors("Historic - Locations",$snippetsHistoric2); ?>
     <?php echoEditors("Historic - General",$snippetsHistoric1); ?>
</div>

<div id="Food" class="tabcontent">
    <?php echoEditors("Food - General",$snippetsFood1); ?>
</div>

<?php
function echoEditors($groupTitle,$formattedSnippets){
    echo "<h1>{$groupTitle}</h1>";
    foreach( $formattedSnippets as $key=>$v){
        echo "<p>";
        echo "<b>{$v->title}</b>";
        echo str_replace("%val%", $v->val,
            "<form action='content' method='post' id='{$v->cat}-{$v->id}'><input type='hidden' value='{$v->cat}' name='cat'><input type='hidden' value='{$v->id}' name='ID'> <input type='submit' value='Update'></form><textarea name='newText' form='{$v->cat}-{$v->id}'>%val%</textarea>"
        );
        echo "</p>";
        }
}
echo "<script>document.getElementById('Start').click()</script>";
 ?>