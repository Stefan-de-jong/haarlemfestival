<?php if(!isset($_SESSION)) {
    session_start();
}
$dance = $_SESSION["dance"];
$artists = $dance[0];
$events = $dance[1];
$eventdata = $dance[2];
$venues = $dance[3];
foreach ($artists as $ar)
{
if ($ar->id == $dance_id)
{
$name = $ar->name;
$bio = $ar->bio;
$style = $ar->style;
}
}
$event_count = 0;
foreach ($events as $e) //get events, filter by ID = 1 to find all the events nicky Romero will perform at and then count those events
{
if ($e->artist == $dance_id)
{$event_count++;}
}
$id = $e->artist;
?>
<link rel="stylesheet" type="text/css" href="../public/css/d_panel.css">
<img style="position: absolute;width: 576px;height: 250px;" src="<?php echo URLROOT; ?>/img/dance/765-default-avatar.png" width="250px" height="250px">
<h5 style="margin-left:600px;">  <?php if(isset($name)){echo $name;}?> <h5>
<p style="position: absolute;margin-left: 600px;margin-bottom: 600px;"><?php if(isset($bio)){echo $bio;} ?></p>
                <section>
                    <div class="table-responsive" style="position: absolute;overflow: visible;margin-top: 302px;width: 836px;height: 200px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Artist</th>
                                    <th>Venue</th>
                                    <th>Address</th>
                                    <th>Tickets</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < $event_count; $i++) {include "newtablerow.php";} ?> <!-- has to add rows equal to the amount of venues the artist performs at -->
                            </tbody>
                        </table>
                    </div>
                    <p style="position: absolute;padding-left: 845px;padding-top: 320px;"><strong>Select your tickets</strong></p><div id=dropdown>
                    <div id=buttons>
                    <?php for ($i = 0; $i < $event_count; $i++) {include "newentry.php";} ?>
                    <div>
<button class="btn btn-primary" id="back" type="button" style="background-color: rgb(255,184,2);">RETURN TO ARTIST PAGE</button></section>
            </div>
<script src="../public/js/panel_script.js"> </script>