<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Profilo</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown04">
              <li><a class="dropdown-item" href="settings.php">Impostazioni</a></li>
              <li><a class="dropdown-item" href="abbonamento.php">Abbonamento</a></li>
              <li><a class="dropdown-item" href="history.php">Cronologia</a></li>
            </ul>
          </li>

        <li><a href="generi.php" class="nav-link px-2 text-white">Generi</a></li>
      </ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-5" method="GET">
        <input type="search" name="ricerca" class="form-control form-control-dark" placeholder="Search...">
      </form>

      <a type="button" href="destruct.php" class="btn btn-primary">Logout</a>
    </div>
  </div>
</header>