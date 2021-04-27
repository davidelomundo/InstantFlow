<?php
session_start();
require_once "../class/genere.php";
require_once '../includes/header.php';
require_once '../includes/database.php';

$database = new Database();
$db = $database->getConnection();
$genere = new Genere($db);

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}


if(isset($_POST["nome"]) && !empty($_POST["nome"]))
{
    $genere->nome = $_POST["nome"];
    
    $genere->newGenre();

    header('Location: ./index.php');
} else {
?>


<h1 class="text-center">Esegui l'iscrizione</h1>

<div class="container">

    <form method="POST">
        <div class="row">

        <label for="nome" class="form-label">Nome genere</label>
            <input type="nome" name="nome" class="form-control" id="nome" placeholder="" required="">
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