<?php
if (!isset($_POST['panelid'])) //if someone tries to access the panel using the website URL in the browser they will be redirected
{
header('Location:index');
}
$dance_id = $_POST['panelid'];
$artists = $data['artists'];
$events = $data['events'];
$eventdata = $data['eventdata'];
$venues = $data['venues'];
$styles = $data['styles'];
$artist_style = $artists[$dance_id-1]->getStyle();
foreach ($styles as $st)
{
if ($st->getId() == $artist_style)
{
    $style = $st->getName();
}
}
foreach ($artists as $ar)
{
if ($ar->getId() == $dance_id)
{
$name = $ar->getName();
$bio = $ar->getBio();
}
}
$event_count = 0;
foreach ($events as $e)
{
if ($e->getArtist() == $dance_id)
{$event_count++;}
}
?>
<section id = artistinfo>
<link rel="stylesheet" type="text/css" href="../public/css/d_panel.css">
<img style="position: absolute;width: 576px;height: 250px;" src="../public/img/dance/765-default-avatar.png" width="250px" height="250px">
<h5 style="margin-left:600px;">  <?php if(isset($name)){echo $name;}?> <h5>
<p style="position: absolute;margin-left: 600px;margin-bottom: 600px;"><?php if(isset($bio)&&(isset($style))){echo $bio . $style;} ?></p>
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
</section>