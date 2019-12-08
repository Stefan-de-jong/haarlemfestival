<?php

if (!isset($_SESSION['dance_ticket']))
{
session_start();
}

$id = $_POST['id'];
$ticket = $_POST['tickets'];
$price = $_POST['price'];

$ticket_info = array();
$ticket_info[] = $id; //sla event id op om later te gebruiken
$ticket_info[] = $ticket; //sla ticket aantal op om later te gebruiken
$ticket_info[] = $price; //sla ticket prijs op om later te gebruiken

if (!isset($_SESSION['dance_ticket']))
{
$_SESSION['dance_ticket'] = array(); //als er nog geen bestelling is geplaatst maak een array
}
$_SESSION['dance_ticket'] = $ticket_info;
//het idee is om bij de kassa de global variable dance_ticket in te lezen, en daar alle kaartjes uit te halen die voor dance
//dus van de array worden steeds drie velden uitgelezen, en met deze drie velden kan steeds één ticket naar de database gestuurd worden
//aangezien je het event_id, vereiste aantal tickets en de prijs hebt. Het enige dat nog toegevoegd moet worden is email van de klant
?>