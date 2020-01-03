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
    <h1 style="float:left; margin-left: 65px; margin-top: 75px"> <?php echo $title; ?> </h1>
    <img style="float:right; margin-top: 45px; margin-right: 25px" onclick="" src="<?php echo URLROOT; ?>/img/header/en_flag.png">
    <img style="float: right; margin-top: 45px; margin-right: 5px" onclick="" src="<?php echo URLROOT; ?>/img/header/nl_flag.png">
    <img height="103px" width="120px" style="float:right; margin-top: 90px; margin-right: -135px" onclick="location.href='<?php echo URLROOT;?>/cart/index'" src="<?php echo URLROOT; ?>/img/cart.png">
    <form class="searchbar" action="<?php echo URLROOT?>/pages/search">
        <input  style="float:right; margin-top: 10px; margin-right: -90px" type="text" placeholder="Search the events!" name="q">
        <button style="float:right; margin-top: 10px;margin-right: -242px" type="submit"><i class="fa fa-search"></i></button>
    </form>
    <?php if(!empty($_SESSION['customer_email'])){?>
    <button id="profileButton" onclick="location.href='<?php echo URLROOT;?>/profile'">Profile</button>
    <?php }else {?>
        <img style="float:right; margin-right: 15px; margin-top: 50px" onclick="location.href='<?php echo URLROOT;?>/customers/login'" src="<?php echo URLROOT; ?>/img/header/log%20in.png">
    <?php }?>
    <nav style="clear:both;">
        <a style="background-color: rgb(255,104,104)" href="<?php echo URLROOT;?>/dance/index">Dance</a>
        <a style="background-color: rgb(152,255,153)" href="<?php echo URLROOT;?>/food">Food</a>
        <a style="background-color: #ffff99" href="<?php echo URLROOT;?>/historic">Historic</a>
        <a style="background-color: #2C88BF" href="<?php echo URLROOT;?>">Jazz</a>
        <a style="background-color: rgb(162,22,174)" href="<?php echo URLROOT;?>/volunteer/index">Volunteer</a>
    </nav>
</header>
<br style="clear:both;">

