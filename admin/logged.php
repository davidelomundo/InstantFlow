<?php
session_start();
require_once "../class/utente.php";
require_once '../includes/header.php';
require_once '../includes/database.php';

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}

echo $_SESSION["idAdmin"];
?>
<h1>Benvenuto</h1>
Aggiungere film, admin, categoria

