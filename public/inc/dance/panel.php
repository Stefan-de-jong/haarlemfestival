<?php if(!isset($_SESSION)) {
    session_start();
}
$dance = $_SESSION["dance"];
$dance_id = $_POST['panelid'];
$artists = $dance[0];
$events = $dance[1];
$eventdata = $dance[2];
$venues = $dance[3];
$styles = $dance[4];
$artist_style = $artists[$dance_id-1]->style;
foreach ($styles as $st)
{
if ($st->id == $artist_style)
{
    $style = $st->name;
}
}
foreach ($artists as $ar)
{
if ($ar->id == $dance_id)
{
$name = $ar->name;
$bio = $ar->bio;
}
}
$event_count = 0;
foreach ($events as $e) //get events, filter by ID = 1 to find all the events nicky Romero will perform at and then count those events
{
if ($e->artist == $dance_id)
{$event_count++;}
}
include 'panel2.php';
?>