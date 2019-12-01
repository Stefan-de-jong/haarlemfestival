<?php
require APPROOT . '/views/inc/header.php';

require APPROOT . '/controllers/Restaurants.php';
$controller = new Restaurants();
$controller->findAllRestaurants();

require APPROOT . '/views/inc/footer.php';
?>