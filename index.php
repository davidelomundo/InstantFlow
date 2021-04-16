<?php
require_once 'includes/navbar.php';
require_once 'includes/header.php';
require_once 'includes/connection.php';



?>

<div class="col-12 container">
    <label for="email" class="form-label">Email</label>

    <form action="action_page.php" method="POST">
    <input type="email" class="form-control" name=email id="email" placeholder="you@example.com">
    <input type="submit" value="Submit">
    </form>
    <div class="invalid-feedback">
    Please enter a valid email address for shipping updates.
    </div>

    <div class="container">
            <b><p class="text-center">Sei un nuovo utente?</p></b>

        <div class="row " >
            <a type="button" class="btn btn-primary col-6" href="./login/index.php">Login</a>
            <a type="button" class="btn btn-warning col-6" href="./signup/index.php">Sign-up</a>
        </div>
    </div>


</div>