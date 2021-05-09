<?php
session_start();

require_once "../includes/database.php";
require_once "../class/film.php";
require_once "../class/genere.php";

require_once "../includes/header.php";
require_once "../includes/navbar.php";

$database = new Database();
$db = $database->getConnection();
$film = new Film($db);
$genere = new Genere($db);

if(empty($_SESSION["idUtente"]))
    header("Location: ../index.php");

$stmtFilm = $film->getFilms();

$stmtGenere = $genere->getGenres();

foreach($stmtGenere as $rowGenere) {
  
  echo "<div class=\"container\"> " . $rowGenere["nome"] . "<hr></div>";

  $stmtFilm = $film->getFilmsByGenre($rowGenere["id"]);

//SELECT * FROM Films JOIN Appartiene ON Films.id=Appartiene.idFilm JOIN Generi ON Appartiene.idGenere=Generi.id WHERE Generi.id= $this->id;

?>

<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($stmtFilm as $rowFilm) {?>
        <div class="col">
          <div class="card shadow-sm">
            <a href=<?= "view.php/?id=" . $rowFilm["id"]?>><img src="<?= "../resources/" . $rowFilm["id"] . "/anteprima.jpg"?>" width="100%" height="100%"></a>

            <div class="card-body">
              <p class="card-text"><?php echo $rowFilm["titolo"] ?></p>
              <hr>
              <p class="card-text"><?php echo $rowFilm["descrizione"] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-secondary" href=<?= "view.php/?id=" . $rowFilm["id"]?>>Avvia</a>
                </div>
                <small class="text-muted"><?php echo date('d/m/Y', strtotime($rowFilm["dataUscita"])) ?></small>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } ?>