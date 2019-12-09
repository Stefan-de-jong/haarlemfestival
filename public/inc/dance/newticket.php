<?php
//the task of this file is to read the ticket data, and then save it in a session variable
if (!isset($_SESSION['dance_ticket']))
{
session_start();
}

$id = $_POST['venue'];
$ticket = $_POST['amount'];
$price = $_POST['price'];

echo $id . $ticket . $price; //currently for developing purposes

$ticket_info = array();
$ticket_info[] = $id; //sla event id op om later te gebruiken
$ticket_info[] = $ticket; //sla ticket aantal op om later te gebruiken
$ticket_info[] = $price; //sla ticket prijs op om later te gebruiken

if (!isset($_SESSION['dance_ticket']))
{
$_SESSION['dance_ticket'] = array(); //als er nog geen bestelling is geplaatst, maak een array
}
$_SESSION['dance_ticket'] = $ticket_info; //plaatst de bestelling in de dance_ticket array, die zelf een array is (waarbij elke entry een bestelling is)
?>