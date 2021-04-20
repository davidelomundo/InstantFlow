<?php
require_once "../includes/header.php";
?>

<h1 class="text-center">Seleziona abbonamento</h1>


<form method="POST" action="../home/index.php">
  <div class="row card-deck mb-3 text-center">
        <div class="col">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Basic</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">€7,99 <small class="text-muted">/ mese</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Risoluzione 720p</li>
              </ul>
              <input type="radio" class="btn-check" name="options-outlined" id="basic-outlined" autocomplete="off" checked>
              <label class="btn btn-lg btn-block btn-outline-primary" for="basic-outlined">Seleziona</label>          </div>
          </div>
        </div>

        <div class="col">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Plus</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">€9,99 <small class="text-muted">/ mese</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Risoluzione 1080p</li>
              </ul>
              <input type="radio" class="btn-check" name="options-outlined" id="plus-outlined" autocomplete="off">
              <label class="btn btn-lg btn-block btn-outline-primary" for="plus-outlined">Seleziona</label>          </div>
          </div>
        </div>

        <div class="col">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Pro</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">€14,99 <small class="text-muted">/ mese</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Risoluzione 2160p</li>
              </ul>
              <input type="radio" class="btn-check" name="options-outlined" id="pro-outlined" autocomplete="off">
              <label class="btn btn-lg btn-block btn-outline-primary" for="pro-outlined">Seleziona</label>
            </div>
          </div>
        </div>
  </div>


  <div class="container row gy-3">
    <h4 class="mb-3">Pagamento</h4>

              <div class="col-md-6">
                <label for="cc-name" class="form-label">Intestatario</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>

              <div class="col-md-6">
                <label for="cc-number" class="form-label">Numero carta</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>

              <div class="col-md-3">
                <label for="cc-expiration" class="form-label">Scadenza</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>

              <div class="col-md-3">
                <label for="cc-cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Continua</button>
            
  </div>
</form>
