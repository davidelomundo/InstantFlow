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
    <b>Si un nuovo utente?</b>

        <div class="row">
            <button type="button" class="btn btn-primary col-6">Login</button>
            <button type="button" class="btn btn-warning col-6">Sign-up</button>
        </div>
    </div>


</div>