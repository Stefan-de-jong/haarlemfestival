<?php
//the task of this file is to read the ticket data, and then save it in a session variable

if (!isset($_POST['venue']) && (!isset($_POST['passday']))) //if someone tries to access the panel using the website URL in the browser they will be redirected
{
    echo "nope, doet het niet";
    var_dump($_POST['passday']);
}
else
{

$passes = $data['passes'];

if (isset($_POST['passday']))
{
$day = $_POST['passday'];
}

if (isset($_POST['venue']))
{
$id = $_POST['venue'];
}

if (isset($_POST['amount']))
{
$amount = $_POST['amount'];
}

if (isset($_POST['remove']))
{
unset($_SESSION['cart'][$id]);
}


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if(isset($id))
{
$cart_item = array(
'dance_ticket' => $amount
);
if(!array_key_exists($id, $_SESSION['cart'])){
    $_SESSION['cart'][$id]=$cart_item;
    echo "true";
}
else
{
    echo "false";
}
}
}

if (isset($day))
{
foreach ($passes as $pass)
{
if ($pass->getName() == $day)
{
$id = $pass->getId();
}
}

$cart_item = array(
    'all_access' => 1
);

if(!array_key_exists($id, $_SESSION['cart'])){
    $_SESSION['cart'][$id]=$cart_item;
    switch ($day)
    { case 'fri': $day = 'Friday'; break;
    case 'sat': $day = 'Saturday'; break;
    case 'sun': $day = 'Sunday'; break;
    case 'all'; $day = 'all days'; break;}
    echo "Added an All-Access Pass for " . $day;
}
else
{
echo "You already ordered an all-Access Pass on this day";
}
}
?>