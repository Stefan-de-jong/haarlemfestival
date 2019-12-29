<?php
    // Load config
    require_once 'config/config.php';

    // Load helper functions
    require_once 'helpers/session_helper.php';
    require_once 'helpers/url_helper.php';

    // Load Mollie
    require_once ("libraries/mollie/vendor/autoload.php");
    require_once ("libraries/mollie/examples/functions.php");

    // Autoload all core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';

    });