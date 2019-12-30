<?php
//the task of this file is to read the ticket data, and then save it in a session variable

if (!isset($_POST['venue'])) //if someone tries to access the panel using the website URL in the browser they will be redirected
{
header('Location:index');
}
else
{

$id = $_POST['venue'];
$amount = $_POST['amount'];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$cart_item = array(
'dance_ticket' => $amount
);

if(!array_key_exists($id, $_SESSION['cart'])){
    $_SESSION['cart'][$id]=$cart_item;
}

echo $id . $amount;
}
?>