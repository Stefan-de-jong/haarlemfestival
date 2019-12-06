<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/login_reg.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/historic.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/food.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/jazz.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">

        <title><?php echo SITENAME; ?></title>
    </head>

    <body>
        <section>
        <img src="<?php echo URLROOT;?>/img/logo.png" class="header_image" alt="JazzGuy">
            <h1 class="headerInfo">
                <?php
                $url = $_SERVER['REQUEST_URI'];
                $array = explode("/",$url);
                echo end($array);
                //echo prev($array);
                ?>
            </h1>
        </section>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
</html>