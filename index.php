<?php

session_start();

require_once "class/utente.php";

require_once 'includes/navbar.php';
require_once 'includes/header.php';
require_once 'includes/database.php';

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

?>

<div class="col-12 container">
        <div class="row " >
            <a type="button" class="btn btn-primary btn-lg col-6" href="./login/index.php">Login</a>
            <a type="button" class="btn btn-warning btn-lg col-6" href="./signup/index.php">Sign-up</a>
        </div>
    </div>
</div>

<div class="text-center">
  <div class="cover-container d-flex p-3 mx-auto flex-column">
        <main role="main" class="inner cover">
          <h1 class="cover-heading">Sei un nuovo utente?</h1>
          <p class="lead">
            <a href="./signup/index.php" class="btn btn-lg btn-secondary">Iscriviti</a>
          </p>
        </main>
      </div>
</div>


<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Abbonamento</h1>
      <p class="lead">Tre tipologie di abbonamento per ogni necessità</p>
    </div>

    <div class="row card-deck mb-3 text-center">

        <div class="col card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Basic</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$7,99 <small class="text-muted">/ mese</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>720p</li>
              <li>2 GB of storage</li>
            </ul>
          </div>
        </div>

        <div class="col card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Plus</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">€9,99 <small class="text-muted">/ mese</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>1080p</li>
              <li>10 GB of storage</li>
            </ul>
          </div>
        </div>

        <div class="col card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">€14,99 <small class="text-muted">/ mese</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>2160p</li>
              <li>15 GB of storage</li>
            </ul>
          </div>
        </div>
      </div>

<?php

foreach($utente->getUsers() as $row)
{
    echo $row['nome'] . "";
}
require_once 'includes/footer.php';
?>