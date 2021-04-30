<?php
session_start();

require_once "../includes/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);
$film = new Film($db);

if(empty($_SESSION["idUtente"]))
    header("Location: ../index.php");

$stmt = $film->getFilms();

?>

<h1 class="text-center">Accesso eseguito</h1>


<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($stmt as $film) {?>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Immagine</text></svg>

            <div class="card-body">
              <p class="card-text"><?php echo $film["titolo"] ?></p>
              <hr>
              <p class="card-text"><?php echo $film["descrizione"] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-secondary" href="<?= $film["id"]?>">Avvia</a>
                </div>
                <small class="text-muted"><?php echo date('d/m/Y', strtotime($film["dataUscita"])) ?></small>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>