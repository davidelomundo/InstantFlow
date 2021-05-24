<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../class/videoStream.php";

if(empty($_SESSION["idUtente"])) {
    header("Location: index.php");
}

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);
$film = new Film($db);
$stream = new VideoStream("../resources/" . $_GET["id"] . "/film.mp4");
$stream->start();

if(empty($_SESSION["idUtente"]))
  header("Location: ../index.php");

if(isset($_GET["ricerca"]) && !empty($_GET["ricerca"])) {
  $film->titolo= $_GET["ricerca"];
  $stmt = $film->findFilm();
} else {
  $stmt = $film->getFilms();
}

?>
