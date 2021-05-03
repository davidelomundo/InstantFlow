<?php
session_start();

require_once "../includes/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../class/videoStream.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

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