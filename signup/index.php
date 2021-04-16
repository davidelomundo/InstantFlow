<?php
require_once '../includes/header.php';
require_once '../includes/connection.php';
?>

<h1 class="text-center">Esegui l'iscrizione</h1>

<div class="container">

    <form>
        <div class="row">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                Valid first name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                Valid last name is required.
                </div>
            </div>
        </div>

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