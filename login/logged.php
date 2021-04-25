<?php
session_start();

require_once "../includes/database.php";
require_once "../class/utente.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

if(empty($_SESSION["idUtente"]))
    header("Location: ../index.php");

echo "Benvenuto idUtente: " . $_SESSION["idUtente"] . "<br>";
echo "I tuoi dati: ";

$utente->id = $_SESSION["idUtente"];
$utente->getInfo();

?>

<h1 class="text-center">Accesso eseguito</h1>