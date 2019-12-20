<?php require_once APPROOT . '/views/inc/header.php';
if(!isset($_SESSION)) {
    session_start();
}
$artists = $data['artists'];
$events = $data['events'];
$eventdata = $data['eventdata'];
$venues = $data['venues'];
$styles = $data['styles'];
$dance = array(
    $artists,
    $events,
    $eventdata,
    $venues,
    $styles
);
$_SESSION["dance"] = $dance;
$pic_count = 0;
?>
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
        <img id="pic1" src="<?php echo URLROOT; $pic_count++; ?>/img/dance/tiesto.png" style="position: absolute;margin-left: 578px;width: 578px;" onclick = "loadPanel(1)">
        <img id="pic2" src="<?php echo URLROOT; $pic_count++; ?>/img/dance/Nicky%20Romoro.png" style="position: absolute;width: 578px;" onclick = "loadPanel(2)">
        <img id="pic3" src="<?php echo URLROOT; $pic_count++; ?>/img/dance/afrojack.png" style="position: absolute;width: 578px;margin-top: 250.859px;" onclick = "loadPanel(3)">
        <img id="pic4" src="<?php echo URLROOT; $pic_count++;?>/img/dance/hardwell.png" style="position: absolute;background-color: rgb(255,104,104);width: 578px;height: 250.859px;margin-left: 578px;margin-top: 250.859px;" onclick = "loadPanel(4)">
        <img id="pic5" src="<?php echo URLROOT; $pic_count++; ?>/img/dance/armin.png" style="position: absolute;width: 578px;margin-top: 501.718px;" onclick = "loadPanel(5)">
        <img id="pic6" src="<?php echo URLROOT; $pic_count++; ?>/img/dance/martin.png" style="position: absolute;width: 578px;margin-top: 501.718px;margin-left: 578px;" onclick = "loadPanel(6)">
            <div class="container text-left visible" id="pnl" style="width: 1152px;height: 750px;display: block;margin-left: 50px;margin-right: 0px;">
    </section>
    <section>
        <h1 style="position: absolute;width: 400px;margin-top: 890px;margin-left: 400px;">ALL-ACCESS PASS</h1>
    </section>
    <p style="position: absolute;margin-top: 884px;margin-left: 754px;width: 250px;">Get access to all venues!<br>Select a day:</p><div id=dropdown>
<div id=dal>
<dropdown>
    <select>
      <option value="fri">Friday</option>
      <option value="sat">Saturday</option>
      <option value="sun">Sunday</option>
    </select>
</dropdown>
</div>
</div><button class="btn btn-primary" type="button" style="position: absolute;margin-top: 889px;margin-left: 1210px;height: 50px;">BUY ALL ACCESS-PASS</button>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script src="<?php echo URLROOT; ?>/js/image_click.js"></script>
<script> var piccount = '<?php echo $pic_count?>'</script>