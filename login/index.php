<?php
require_once '../includes/header.php';
require_once '../includes/connection.php';
?>

<?php

if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]))
{
    $stmt = $connessione->prepare("SELECT *, COUNT(*) AS numRows FROM Utenti WHERE email='" . $_POST["email"] . "' AND password='" . $_POST["password"] . "';");
    $stmt->execute(array("%$query%"));

    // iterating over a statement
    foreach($stmt as $row) {
        if($row["numRows"] > 0)
        {
            echo (strval($row["id"] . $row['email'] . $row['password'] . $row['isAdmin']));
            header('Location: ./logged.php');
        }
    }
} else {
?>

<h1 class="text-center">Esegui l'accesso</h1>

<div class="container">
    <form method="POST">

        <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
            </div>

        <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
            </div>

        <button type="submit" class="btn btn-success">Invio</button>
    </form>
</div>


<?php
}
?>