<?php
require_once 'includes/navbar.php';
require_once 'includes/header.php';
require_once 'includes/connection.php';
?>


<?php

$tmp = 'SELECT * FROM utenti;';

$risultato=$connessione->query($tmp);
$rows = $risultato->fetchAll(PDO::FETCH_NUM);

foreach($rows as $row) {
    //printf("$row[0] $row[1] $row[2] $row[3]\n");
}

?>

<div class="col-12 container">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" placeholder="you@example.com">
    <div class="invalid-feedback">
    Please enter a valid email address for shipping updates.
    </div>
</div>