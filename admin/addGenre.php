<?php
session_start();
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../class/genere.php";
require_once '../includes/database.php';


require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);
$film = new Film($db);
$genere = new Genere($db);

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}

$stmtGenere = $genere->getGenres();

?>

<form action="/action_page.php">
  <label for="cars">Scegli un genere</label>
  <select name="cars" id="cars">
  <?php foreach($stmtGenere as $rowGenere) {?>
    <option><?php echo $rowGenere["nome"] ?></option>
    <?php } ?>
  </select>
  <br><br>
  <input type="submit" value="Aggiungi">
</form>