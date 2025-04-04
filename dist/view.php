<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../class/guarda.php";
require_once "../class/videoStream.php";

if(!isset($_SESSION["idUtente"]) && empty($_SESSION["idUtente"])) {
    header("Location: index.php");
}

$database = new Database();
$db = $database->getConnection();

$utente = new Utente($db);
$film = new Film($db);
$guarda = new Guarda($db);
$stream = new VideoStream("../resources/" . $_GET["id"] . "/film.mp4");

$guarda->idUtente = $_SESSION["idUtente"];
$guarda->idFilm = $_GET["id"];
$guarda->createLog();

$stream->start();
?>
