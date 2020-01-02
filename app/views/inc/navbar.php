<?php $url = $_SERVER['REQUEST_URI'];
$color = "rgb(242, 242, 242)";
$title = "Haarlem Festival";
if (strpos($url, 'food'))
{$color = "rgb(152,255,153)";
$title = $title . " - Food";
}
else if (strpos($url, 'dance'))
{$color = "rgb(255,104,104)";
$title = $title . " - Dance";
}
else if (strpos($url, 'historic'))
{$color = "yellow";
$title = $title . " - Historic";
}
else if (strpos($url, 'volunteer'))
{$color = "rgb(162,22,174)";
$title = $title . " - Volunteer";
}
?>
<header style="background-color: <?php echo $color; ?>; width: 100%">
<h1> <?php echo $title; ?> </h1>
    <img onclick="location.href='<?php echo URLROOT;?>'" src="<?php echo URLROOT; ?>/img/header/logo_bold-outline.png">
    <img onclick="location.href='<?php echo URLROOT;?>/program/index'" src="<?php echo URLROOT; ?>/img/header/programme.png">
    <img onclick="location.href='<?php echo URLROOT;?>/customers/login'" src="<?php echo URLROOT; ?>/img/header/log%20in.png">
    <img onclick="" src="<?php echo URLROOT; ?>/img/header/en_flag.png">
    <img onclick="" src="<?php echo URLROOT; ?>/img/header/nl_flag.png">
    <img onclick="location.href='<?php echo URLROOT;?>/cart/index'" src="<?php echo URLROOT; ?>/img/header/cart.png">

    <nav>
        <a style="background-color: rgb(255,104,104)" href="<?php echo URLROOT;?>/dance/index">Dance</a>
        <a style="background-color: rgb(152,255,153)" href="<?php echo URLROOT;?>/food/index">Food</a>
        <a style="background-color: yellow" href="<?php echo URLROOT;?>/historic">Historic</a>
        <a style="background-color: blue" href="<?php echo URLROOT;?>">Jazz</a>
        <a style="background-color: rgb(162,22,174)" href="<?php echo URLROOT;?>/volunteer/index">Volunteer</a>
    </nav>

    <br style="clear:both;">
</header>

