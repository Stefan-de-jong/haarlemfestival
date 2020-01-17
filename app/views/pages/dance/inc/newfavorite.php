<?php
if (!isset($_POST['favoriteid'])) //if someone tries to access the panel using the website URL in the browser they will be redirected
{
header('Location:index');
}
$favorites = $data['favorite'];
if (isset($_POST['favoriteid']))
{
$favoriteid = $_POST['favoriteid'];
}
$favorites->addFavorite($_SESSION['customer_id'], $favoriteid);
?>