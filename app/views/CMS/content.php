<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<?php
$snippets = $data['data'];
$snippetsDance = $snippets["dance"];
$snippetsHistoric1 = $snippets['historicMain'];
$snippetsHistoric2 = $snippets['historicRoute'];
?>
<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'Dance')">Dance</button>
    <button class="tablinks" onclick="openTab(event, 'Historic')">Historic</button>
    <button class="tablinks" onclick="openTab(event, 'Food')">Food</button>
</div>

<div id="Dance" class="tabcontent">
    <h3>Dance</h3>
    <?php
    echo "<h1>Artist Info</h1>";
    foreach( $snippetsDance as $key=>$value){
        echo "<p>";
        echo "<b>{$value->artist_name}</b>";
        ?>
        <form action="content" method="post" id="dance<?php echo $value->artist_id;?>">
            <input type="hidden" value="1" name="cat">
            <input type="hidden" value="<?php echo $value->artist_id; ?>" name="ID">
            <input type="submit" value="Update">
        </form>
        <textarea name="newText" form="dance<?php echo $value->artist_id;?>"><?php echo $value->bio; ?></textarea>
        <?php
        echo "</p>";
    }
    ?>
</div>

<div id="Historic" class="tabcontent">
    <h3>Historic</h3>
    <?php
    echo "<h1>Route Info</h1>";
    foreach( $snippetsHistoric2 as $key=>$value){
        echo "<p>";
        echo "<b>Location - {$value->name}</b>";
        ?>
        <form action="content" method="post" id="historic<?php echo $value->name;?>">
            <input type="hidden" value="3" name="cat">
            <input type="hidden" value="<?php echo $value->name; ?>" name="ID">
            <input type="submit" value="Update">
        </form>
        <textarea name="newText" form="historic<?php echo $value->name;?>"><?php echo $value->description; ?></textarea>
        <?php
        echo "</p>";
    }
    ?>

</div>

<div id="Food" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
</div>

<?php
public function echoEditors($groupTitle,$formattedSnippets){
    foreach( $formattedSnippets as $key=>$v){
        echo "<p>";
        echo "<b>{$v->title}</b>";
        echo '<form action="content" method="post" id="{$v->cat}-{$v->id}"><input type="hidden" value="{$v->cat}" name="cat"><input type="hidden" value="{$v->id}" name="ID"> <input type="submit" value="Update"></form><textarea name="newText" form="{$v->cat}-{$v->id}">{$v->val}></textarea>';
        echo "</p>";
        }
}
 ?>

?>