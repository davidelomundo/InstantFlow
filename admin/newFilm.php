<?php
session_start();
require_once "../class/utente.php";
require_once '../includes/header.php';
require_once '../includes/database.php';

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

if(empty($_SESSION["idAdmin"])) {
    header("Location: index.php");
}


if(isset($_POST["firstName"]) && !empty($_POST["firstName"]) && isset($_POST["lastName"]) && !empty($_POST["lastName"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]))
{
    $utente->nome = $_POST["firstName"];
    $utente->cognome = $_POST["lastName"];
    $utente->email = $_POST["email"];
    $utente->password = $_POST["password"];
    
    $utente->createAdmin();

    header('Location: ./index.php');
} else {
?>


<h1 class="text-center">Esegui l'iscrizione</h1>

<div class="container">

    <form method="POST">
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
            <input type="date" name="data" class="form-control" id="data" placeholder="" required="">
            <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
            </div>

        <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="">
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