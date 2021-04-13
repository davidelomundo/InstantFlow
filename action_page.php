<?php
require_once 'includes/connection.php';

$tmp = "SELECT * FROM utenti WHERE utenti.email=" . '\'' . $_GET["email"] . '\'';

$risultato=$connessione->query($tmp);
$rows = $risultato->fetchAll(PDO::FETCH_NUM);

foreach($rows as $row) {
    printf("$row[0] $row[1] $row[2] $row[3]\n");
}

?>