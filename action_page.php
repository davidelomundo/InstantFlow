<?php
require_once 'includes/connection.php';
$email = $_GET["email"];

$stmt = $connessione->prepare("SELECT * FROM Utenti WHERE email='" . $email . "';");
$stmt->execute(array("%$query%"));

// iterating over a statement
foreach($stmt as $row) {
    echo $row['email'];
}

?>