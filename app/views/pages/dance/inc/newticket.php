<?php
//the task of this file is to read the ticket data, and then save it in a session variable

if (!isset($_POST['venue'])) //if someone tries to access the panel using the website URL in the browser they will be redirected
{
header('Location:index');
}

$id = $_POST['venue'];
$ticket = $_POST['amount'];
$price = $_POST['price'];

echo $id . $ticket . $price; //currently for developing purposes
?>