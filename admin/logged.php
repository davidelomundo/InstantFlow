<?php
session_start();
require_once "../class/utente.php";
require_once '../includes/header.php';
require_once '../includes/database.php';

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}

?>
<h1>Benvenuto</h1>
Aggiungere film, admin, categoria

<a href="newAdmin.php" class="btn btn-primary">Admin</a>
<a href="newFilm.php" class="btn btn-primary">Film</a>
<a href="newCategory.php" class="btn btn-primary">Categoria</a>
