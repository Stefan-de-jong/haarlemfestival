<?php $url = $_SERVER['REQUEST_URI'];
$color = " darksalmon";
$title = "Haarlem Festival";
if (strpos($url, 'search')) {} //als een zoekopdracht een naam van een van de thema's bevat veranderde de kleur dus dit voorkomt dat
else if (strpos($url, 'food'))
{$color = "rgb(152,255,153)";
$title = $title . " - Food";
}
else if (strpos($url, 'dance'))
{$color = "rgb(255,104,104)";
$title = $title . " - Dance";
}
else if (strpos($url, 'historic'))
{$color = "#ffff99";
$title = $title . " - Historic";
}
else if (strpos($url, 'volunteer'))
{$color = "rgb(162,22,174)";
$title = $title . " - Volunteer";
}
else if (strpos($url, 'cart'))
{
    $color= "#3C2381";
    $title = $title . " - Cart";
}
else if (strpos($url, 'program'))
{
    $color= "#3C2381";
    $title = $title . " - Program";
}
?>
<header style="background-color: <?php echo $color; ?>; width: 100%; height: 200px">
    <img height="175x" onclick="location.href='<?php echo URLROOT;?>'" src="<?php echo URLROOT; ?>/img/header/logo_bold-outline.png">
    <img style="margin-left: 35px; margin-top: 50px" onclick="location.href='<?php echo URLROOT;?>/program/index'" src="<?php echo URLROOT; ?>/img/header/programme.png">
    <h1 style="float:left; margin-left: 100px; margin-top: 75px"> <?php echo $title; ?> </h1>
    <img style="margin-left: 150px; margin-top: 50px" onclick="location.href='<?php echo URLROOT;?>/customers/login'" src="<?php echo URLROOT; ?>/img/header/log%20in.png">
    <div id="google_translate_element" style="padding-top: 50px"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</form>
</div>
    <img height="103px" width="120px" style="float:right; margin-top: 75px; margin-right: -135px" onclick="location.href='<?php echo URLROOT;?>/cart/index'" src="<?php echo URLROOT; ?>/img/cart.png">
    <form class="searchbar" action="http://localhost/haarlemfestival/search.php"></form>
     <input style="margin-top: 60px; margin-left: 210px;" type="text" placeholder="Search the events!" name="q">
     <button type="submit"><i class="fa fa-search"></i></button>

    <nav style="clear:both;">
        <a style="background-color: rgb(255,104,104)" href="<?php echo URLROOT;?>/dance/index">Dance</a>
        <a style="background-color: rgb(152,255,153)" href="<?php echo URLROOT;?>/food">Food</a>
        <a style="background-color: #ffff99" href="<?php echo URLROOT;?>/historic">Historic</a>
        <a style="background-color: #2C88BF" href="<?php echo URLROOT;?>">Jazz</a>
        <a style="background-color: rgb(162,22,174)" href="<?php echo URLROOT;?>/volunteer/index">Volunteer</a>
    </nav>
</header>
<br style="clear:both;">

