<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "../class/film.php";
require_once '../includes/header.php';
require_once '../includes/database.php';

$database = new Database();
$db = $database->getConnection();
$film = new Film($db);

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}


if(isset($_POST["titolo"]) && !empty($_POST["titolo"]) && isset($_POST["descrizione"]) && !empty($_POST["descrizione"]) && isset($_POST["dataUscita"]) && !empty($_POST["dataUscita"]))
{
    $film->titolo = $_POST["titolo"];
    $film->dataUscita = date('Y-m-d', strtotime($_POST["dataUscita"]));
    $film->descrizione = $_POST["descrizione"];
    $film->createFilm();

    $rowFilm = $film->getInfo();
    mkdir("../resources/" . $rowFilm["id"]);

    move_uploaded_file($_FILES["anteprima"]["tmp_name"], "../resources/" . $rowFilm["id"] . "/anteprima.jpg");
    move_uploaded_file($_FILES["film"]["tmp_name"], "../resources/" . $rowFilm["id"] . "/film.mp4");

    header('Location: ./index.php');
} else {
?>



<h1 class="text-center">Esegui l'iscrizione</h1>

<div class="container">

    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" name="titolo" class="form-control" id="titolo" placeholder="" value="" required="">
                <div class="invalid-feedback">
                Valid first name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="descrizione" class="form-label">Descrizione</label>
                <input type="text" name="descrizione" class="form-control" id="descrizione" placeholder="" value="" required="">
                <div class="invalid-feedback">
                Valid last name is required.
                </div>
            </div>
        </div>

        <label for="email" class="form-label">Data</label>
            <input type="date" name="dataUscita" class="form-control" id="dataUscita" placeholder="" required="">
            <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
            </div>
        
        <label for="email" class="form-label">Anteprima</label>
            <input type="file" accept="image/*" name="anteprima" class="form-control" id="anteprima" placeholder="" required="">
            <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
            </div>

        <label for="email" class="form-label">Film</label>
            <input type="file" accept="video/*" name="film" class="form-control" id="film" placeholder="" required="">
            <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
            </div>
            
        <div class="row text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg">Invio</button>
        </div>
    </form>

</div>

<?php
}
?>