<?php require_once APPROOT . '/views/inc/header.php';
$artists = $data['artists'];
$pic_count = 0;
?>
<style> footer{margin-top: <?php $pxadjustment ?>}</style>
    <section id="bg-image" style="position: absolute;"><img src="<?php echo URLROOT; ?>/img/dance/bg-left.png" style="position: absolute;"><img style="position: absolute;margin-left: 1539px;" src="<?php echo URLROOT; ?>/img/dance/bg-right.png"></section>
    <section class="text-left" id="main-content" style="position: absolute;background-color: rgb(255,104,104);width: 1156px;height: 979px;margin-left: 384px;">
        <ol class="breadcrumb" style="background-color: rgb(255,255,255);">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/dance/index"><span>dance information page</span></a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/dance/purchase"><span>dance purchase page</span></a></li>
        </ol>
        <h4 class="text-center">Click an artist to view information and tickets.
        <br></h4>
        <section class="text-center"></section>
        <?php $x = 0; $y = 0; $count = 0; $rows_2_photos = 0;?>
        <?php foreach ($data['artists'] as $artist) :?>
        <?php $rows_2_photos = intval($count / 2); $x = 250.86 * $rows_2_photos; ?>
        <img id="pic<?php echo $artist->getId();?>" src="<?php echo URLROOT; ?>/img/dance/artist_image_<?php echo $artist->getId();?>.png" style="position: absolute; width: 578px; margin-top: <?php echo $x ?>px; margin-left: <?php echo $y ?>px;" onclick = "loadPanel(<?php echo $artist->getId();?>)"> <?php $count++; ?>
        <?php if ($y == 0) {$y = 578;} else {$y = 0;} ?>
         <?php endforeach; ?>
            <div class="container text-left visible" id="pnl" style="width: 1152px;height: 750px;display: block;margin-left: 50px; margin-right: 0px;">
    </section>
    <?php $adjustment = $rows_2_photos - 3; if ($adjustment < 1) {$pxadjustment = 124 + ($adjustment * 250.86);} else {$pxadjustment = $adjustment * 250.86;}?>
    <section id = "padding"; style = "background-color: rgb(255,104,104); padding-left: 200px; padding-right: 578px; padding-top:<?php echo $pxadjustment; ?>px; padding-bottom:<?php echo $pxadjustment?>px; margin-top: 979px; position: block;">
    </section>
    <section id='pass'>
    <section>
        <h1 style="position: relative;width: 400px; margin-top:-100px;margin-left: 400px;">ALL-ACCESS PASS</h1>
    </section>
    <p id='pricebox' style="position: relative;margin-top: -50px;margin-left: 754px;width: 250px;">Get access to all venues!<br>Select a day:</p><div id=dropdown>
<div id=dal>
<dropdown style = "margin-left: 950px; margin-top: -57px; position: absolute;">
    <select style = "padding: 7.5px;" id="pass-select">
      <option value="fri">Friday</option>
      <option value="sat">Saturday</option>
      <option value="sun">Sunday</option>
      <option value="all">All</option>
    </select>
</dropdown>
</div>
</div><button id='pass-button' class="btn btn-primary" type="button" style="position: relative;margin-top: -105px;margin-left: 1100px;height: 50px;" onclick = "addPass()">BUY ALL ACCESS-PASS</button>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script src="<?php echo URLROOT; ?>/js/image_click.js"></script>
<script> var piccount = '<?php echo $count?>'; </script>