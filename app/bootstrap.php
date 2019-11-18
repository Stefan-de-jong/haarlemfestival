<?php
    // Load config
    require_once 'config/config.php';

    // Autoload all core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
    });