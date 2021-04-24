<?php
session_start();

require_once "../includes/header.php";
require_once "../includes/navbar.php";

echo "Benvenuto " . $_SESSION["email"];

?>

<h1 class="text-center">Accesso eseguito</h1>