<?php

if (!isset($_SESSION['dance_ticket']))
{
session_start();
}

$id = $_POST['id'];
$ticket = $_POST['tickets'];
$price = $_POST['price'];


//weet niet of het toegestaan is vanaf hier de repo aan te roepen?
//anders moet ik een andere manier vinden
//officeel gezien moet namelijk de controller de repo aanroepen maar deze php page mag niet onderdeel zijn van de controller

$ticket_info = array();
$ticket_info[] = $id; //sla event id op om later te gebruiken
$ticket_info[] = $ticket; //sla ticket aantal op om later te gebruiken
$ticket_info[] = $price; //sla ticket prijs op om later te gebruiken

if (!isset($_SESSION['dance_ticket']))
{
$_SESSION['dance_ticket'] = array(); //als er nog geen bestelling is geplaatst maak een array
}
$_SESSION['dance_ticket'] = $ticket_info;

?>