<?php
$favorites = $data['favorite'];
if (isset($_POST['favoriteid']))
{
$favoriteid = $_POST['favoriteid'];
}
echo $favoriteid;
$favorites->addFavorite($_SESSION['customer_id'], $favoriteid);
?>