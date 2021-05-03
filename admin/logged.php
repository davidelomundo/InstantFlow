<?php
session_start();
require_once "../class/utente.php";
require_once "../class/film.php";
require_once '../includes/header.php';
require_once '../includes/database.php';
require_once '../includes/navbarAdmin.php';

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);
$film = new Film($db);

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}

if(isset($_GET["removeFilm"]) && !empty($_GET["removeFilm"])) {
    $film->id = $_GET["removeFilm"];
    $film->delete();
    header("Location: index.php");
}

if(isset($_GET["ricerca"]) && !empty($_GET["ricerca"])) {
  $film->titolo= $_GET["ricerca"];
  $stmt = $film->findFilms();
} else {
  $stmt = $film->getFilms();
}

?>

<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($stmt as $film) {?>
        <div class="col">
          <div class="card shadow-sm">
            <a href=<?= "view.php/?id=" . $film["id"]?>><img src="<?= "../resources/" . $film["id"] . "/anteprima.jpg"?>" width="100%" height="100%"></a>

            <div class="card-body">
              <p class="card-text"><?php echo $film["titolo"] ?></p>
              <hr>
              <p class="card-text"><?php echo $film["descrizione"] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-danger" href=<?= "?removeFilm=" . $film["id"]?>>Elimina</a>
                </div>
                <small class="text-muted"><?php echo date('d/m/Y', strtotime($film["dataUscita"])) ?></small>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>