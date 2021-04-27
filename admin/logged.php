<?php
session_start();
require_once "../class/utente.php";
require_once '../includes/header.php';
require_once '../includes/database.php';

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}

?>

<a href="newAdmin.php" class="btn btn-primary">Admin</a>
<a href="newFilm.php" class="btn btn-primary">Film</a>
<a href="newGenre.php" class="btn btn-primary">Genere</a>
<a href="destruct.php" class="btn btn-danger">Esci</a>
