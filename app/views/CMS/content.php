<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<?php
$snippets = $data['data'];
$snippetsDance = $snippets["dance"];
$snippetsHistoric1 = $snippets['historicMain'];
$snippetsHistoric2 = $snippets['historicRoute'];
$snippetsFood1 = $snippets['foodMain'];
$snippetsFood2 = $snippets['foodRestaurants'];
?>

    <button class="tablink" onclick="openPage('Dance', this, 'red')" id="defaultOpen">Dance</button>
    <button class="tablink" onclick="openPage('Historic', this, 'green')">Historic</button>
    <button class="tablink" onclick="openPage('Food', this, 'blue')">Food</button>

<div id="Dance" class="tabcontent">
    <?php
    if (isset($data['Message'])){
        echo "<span>{$data['Message']}</span>";
    }
    ?>
    <?php echoEditors("Dance",$snippetsDance); ?>
</div>

<div id="Historic" class="tabcontent">
    <?php
    if (isset($data['Message'])){
        echo "<span>{$data['Message']}</span>";
    }
    ?>
     <?php echoEditors("Historic - Locations",$snippetsHistoric2); ?>
     <?php echoEditors("Historic - General",$snippetsHistoric1); ?>
</div>

<div id="Food" class="tabcontent">
    <?php
    if (isset($data['Message'])){
        echo "<span>{$data['Message']}</span>";
    }
    ?>
    <?php echoEditors("Food - General",$snippetsFood1); ?>
</div>

<?php
function echoEditors($groupTitle,$formattedSnippets){
    echo "<h1>{$groupTitle}</h1>";
    foreach( $formattedSnippets as $key=>$v){
        echo "<p>";
        echo "<b>{$v->title}</b>";
        echo str_replace("%val%", $v->val,
            "<div class = 'txtarea'><form action='content' method='post' id='{$v->cat}-{$v->id}'><input type='hidden' value='{$v->cat}' name='cat'><input type='hidden' value='{$v->id}' name='ID'> <input class='update' type='submit' value='Update'></form><textarea name='newText' form='{$v->cat}-{$v->id}'>%val%</textarea></div>"
        );
        ?>
<script src="https://cdn.tiny.cloud/1/7a6z415bc5uf8mx9kms9qodrcmq4q1r5qsf0qs50kb4brv2o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
  <script>
      tinymce.init({
          selector: 'textarea',
          plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          toolbar_mode: 'floating',
      });
  </script>
  <?php
        echo "</p>";
        }
}
 ?>

