<?php
require_once '../includes/header.php';
require_once '../includes/connection.php';

if(isset($_POST["firstName"]) && !empty($_POST["firstName"]) && isset($_POST["lastName"]) && !empty($_POST["lastName"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]))
{
    echo "Ok";
    $stmt = $connessione->prepare("INSERT INTO Utenti (nome, cognome, email, password, isAdmin) VALUES(?, ?, ?, ?, ?)");
    $stmt->execute([$_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"], 0]);

    header('Location: ./abbonamento.php');
} else {
?>


<h1 class="text-center">Esegui l'iscrizione</h1>

<div class="container">

    <form method="POST">
        <div class="row">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                Valid first name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                Valid last name is required.
                </div>
            </div>
        </div>

        <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required="">
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