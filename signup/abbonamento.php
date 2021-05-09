<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../class/abbonamento.php";
require_once "../class/cartaDiCredito.php";
require_once "../class/categoria.php";

require_once "../includes/database.php";
require_once "../includes/header.php";

$database = new Database();
$db = $database->getConnection();
$carta = new CartaDiCredito($db);
$abbonamento = new Abbonamento($db);
$categoria = new Categoria($db);

if(isset($_POST["nomeIntestatario"]) && !empty($_POST["nomeIntestatario"]) && isset($_POST["cognomeIntestatario"]) && !empty($_POST["cognomeIntestatario"]) && isset($_POST["numero"]) && !empty($_POST["numero"]) && isset($_POST["scadenza"]) && !empty($_POST["scadenza"]) && isset($_POST["cvv"]) && !empty($_POST["cvv"])) {
  
  $carta->nome = $_POST["nomeIntestatario"];
  $carta->cognome = $_POST["cognomeIntestatario"];
  $carta->numero = $_POST["numero"];
  $carta->scadenza = date('Y-m-d', strtotime($_POST["scadenza"]));
  $carta->cvv = $_POST["cvv"];
  $carta->idUtente = $_SESSION["idUtente"];
  $carta->newPayment();

  $abbonamento->idCategoria = $_POST["categoriaAbbonamento"];
  $abbonamento->newAbbonamento();

  header("Location: ../login/logged.php");
} else {

  $stmtCategoria = $categoria->getCategory();
?>
<h1 class="text-center">Seleziona abbonamento</h1>


<form method="POST">
<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="row">
    <?php foreach($stmtCategoria as $rowCategoria) { ?>
        <div class="col">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal"><?php echo $rowCategoria["nome"] ?></h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title"><?php echo $rowCategoria["prezzo"] ?> <small class="text-muted">/ mese</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Risoluzione 720p</li>
              </ul>
              <input type="radio" class="btn-check" name="categoriaAbbonamento" id="basic-outlined" autocomplete="off" value="<?= $rowCategoria["id"]?>">
              <label class="btn btn-lg btn-block btn-outline-primary" for="basic-outlined">Seleziona</label>          </div>
          </div>
        </div>
        <?php } ?>
    </div>
  </div>
</div>


  <div class="container row gy-3">
    <h4 class="mb-3">Pagamento</h4>

              <div class="col-md-6">
                <label for="cc-name" class="form-label">Nome intestatario</label>
                <input type="text" class="form-control" name="nomeIntestatario" id="cc-name" placeholder="" required="">
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>

              <div class="col-md-6">
                <label for="cc-lastname" class="form-label">Cognome intestatario</label>
                <input type="text" class="form-control" name="cognomeIntestatario" id="cc-lastname" placeholder="" required="">
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>

              <div class="col-md-6">
                <label for="cc-number" class="form-label">Numero carta</label>
                <input type="text" class="form-control" name="numero" id="cc-number" placeholder="" required="">
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>

              <div class="col-md-3">
                <label for="cc-expiration" class="form-label">Scadenza</label>
                <input type="date" class="form-control" name="scadenza" id="cc-expiration" placeholder="" required="">
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>

              <div class="col-md-3">
                <label for="cc-cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" name="cvv" id="cc-cvv" placeholder="" required="">
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Continua</button>

            <div id="paypal-payment-button">

            </div>
            <script src="https://www.paypal.com/sdk/js?client-id=AU4Ch6aleHdD0GW2goBAlWQsBG3z6E-QLPBAoxN4VqaH_NK3h9uUrBOWSg5FD4mY386NtzqnxjFOOAYO&disable-funding=credit,card,mybank,sofort&currency=EUR&locale=it_IT"></script>
            <script src="index.js"></script>
  </div>
</form>

<?php
}
?>