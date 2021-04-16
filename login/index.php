<?php
require_once '../includes/header.php';
?>

<?php

if(isset($_POST["email"]) && !empty($_POST["email"]))
{
    echo "Ok";
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
        <input type="password" class="form-control" id="password" placeholder="Password">
        <div class="invalid-feedback">
        Please enter a valid email address for shipping updates.
        </div>

        <button type="submit">Invio</button>
    </form>
</div>

<?php
}
?>