<?php
require_once 'includes/navbar.php';
require_once 'includes/header.php';
require_once 'includes/connection.php';




?>

<div class="col-12 container">
    <div class="container">
            <b><p class="text-center">Sei un nuovo utente?</p></b>

        <div class="row " >
            <a type="button" class="btn btn-primary btn-lg col-6" href="./login/index.php">Login</a>
            <a type="button" class="btn btn-warning btn-lg col-6" href="./signup/index.php">Sign-up</a>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
    </div>

    <div class="bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
    </div>
    
    <div class="bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
    </div>
  </div>

<?php
require_once 'includes/footer.php';
?>