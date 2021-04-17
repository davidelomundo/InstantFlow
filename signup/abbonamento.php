<?php
require_once "../includes/header.php";
?>

<h1 class="text-center">Seleziona abbonamento</h1>

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
            <input type="radio" class="btn-check" name="options-outlined" id="basic-outlined" autocomplete="off">
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