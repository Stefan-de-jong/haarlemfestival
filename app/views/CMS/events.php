<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<?php
$events = $data["events"];
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
        <?php echoEditors("Dance",$events); ?>
    </div>

    <div id="Historic" class="tabcontent">
    </div>

    <div id="Food" class="tabcontent">

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