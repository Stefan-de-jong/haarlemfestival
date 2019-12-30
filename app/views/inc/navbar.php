<?php $url = $_SERVER['REQUEST_URI'];
$color = "rgb(242, 242, 242)";
$title = "Haarlem Festival";
if (strpos($url, 'restaurants'))
{$color = "green";
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
<section style="background-color: <?php echo $color; ?>; width: 1920px;">
<h1 style="padding-left: 500px; position: absolute; padding-top: 70px"> <?php echo $title; ?> </h1>
    <section><a href="<?php echo URLROOT;?>"><img src="<?php echo URLROOT; ?>/img/header/logo_bold-outline.png"><img src="<?php echo URLROOT; ?>/img/header/programme.png" style="padding-left: 5px;"><a href="<?php echo URLROOT;?>/customers/login"><img src="<?php echo URLROOT; ?>/img/header/log%20in.png" style="padding-left: 1070px;padding-bottom: 19px;height: 139px;"><img src="<?php echo URLROOT; ?>/img/header/en_flag.png" style="position: absolute;padding-top: 30px;padding-left: 85px;">
        <img src="<?php echo URLROOT; ?>/img/header/nl_flag.png" style="position: absolute;padding-top: 30px;padding-left: 20px;"><img src="<?php echo URLROOT; ?>/img/header/cart.png" style="padding-top: 23px;padding-left: 20px;width: 145px;height: 100px;">
            <section><a href="<?php echo URLROOT;?>/restaurants/index"><img src="<?php echo URLROOT; ?>/img/header/food_tile.png"><a href="<?php echo URLROOT;?>/dance/index"><img src="<?php echo URLROOT; ?>/img/header/dance_tile.png"><a href="<?php echo URLROOT;?>/historic"><img src="<?php echo URLROOT; ?>/img/header/history_tile.png"><a href="<?php echo URLROOT;?>"><img src="<?php echo URLROOT; ?>/img/header/jazz_tile.png"><a href="<?php echo URLROOT;?>/volunteer/index"><img src="<?php echo URLROOT; ?>/img/header/volunteers_tile.png" style="width: 384px;position: absolute;"></section>
    </section>
    <a href=""></a>
</section>

<<<<<<< HEAD
</html>
=======
<a href="<?php echo URLROOT;?>" class="btn btn-light">Home</a>
<a href="<?php echo URLROOT;?>/customers/login" class="btn btn-light">Customer Login</a>
<a href="<?php echo URLROOT;?>/CMS" class="btn btn-light">CMS Login</a>
<a href="<?php echo URLROOT;?>/historic" class="btn btn-light">Historic</a>
<a href="<?php echo URLROOT;?>/dance/index" class="btn btn-light">Dance</a>
<a href="<?php echo URLROOT;?>/food/index" class="btn btn-light">Food</a>
<a href="<?php echo URLROOT;?>/cart/index" class="btn btn-light">Cart----Test</a>
<a href="<?php echo URLROOT;?>/program/index" class="btn btn-light">Program----Test</a>
>>>>>>> stefbranch
