<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../class/abbonamento.php";

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);
$film = new Film($db);
$abbonamento = new Abbonamento($db);

if(!isset($_SESSION["idUtente"]) && empty($_SESSION["idUtente"])) {
    header("Location: index.php");
} else {
    $abbonamento->idUtente = $_SESSION["idUtente"];
    if(!$abbonamento->isSubscribed()) {
        header("Location: abbonamento.php");
    }
}

if(isset($_GET["ricerca"]) && !empty($_GET["ricerca"])) {
    $film->titolo= $_GET["ricerca"];
    $stmtFilm = $film->findFilms();
} else {
    $stmtFilm = $film->getFilms();
}

$utente->id = $_SESSION["idUtente"];
$rowUtente = $utente->getInfo();
?>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>                    
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand text-white" href="logged.php">InstantFlow</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">                                    
                                <li class="nav-item dropdown no-caret">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $rowUtente["nome"]; ?><i class="fas fa-chevron-right dropdown-arrow"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                                        <a class="dropdown-item py-3" href="settings.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-gear"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Impostazioni</div>
                                                Gestisci i dati del tuo account
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-credit-card-2-front-fill"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Abbonamento</div>
                                                Controlla la scadenza o rinnova l'abbonamento
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-clock-history"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Cronologia</div>
                                                La cronologia degli ultimi film che hai guardato
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="destruct.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-power"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Esci</div>
                                                Effettua il logout dalla piattaforma
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="generi.php">Generi</a></li>
                            </ul>
                            <form>
                                <div class="form-row justify-content-center">
                                    <div>
                                        <div class="form-group mr-0 mr-lg-2"><label class="sr-only" for="inputSearch">Cerca...</label><input class="form-control form-control-solid rounded-pill" id="inputSearch" name="ricerca" type="text" placeholder="Cerca..." /></div>
                                    </div>
                                    <div><button class="btn-teal btn rounded-pill px-4 ml-lg-4" type="submit">Cerca</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-content pt-10">
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="page-header-title mb-3">Raccolta</h1>
                                    <p class="page-header-text">La tua raccolta in espansione ogni giorno.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                    </div>
                </header>
                <section class="bg-light py-10">
                    <div class="container">
                        <div class="row text-center">
                            <?php foreach($stmtFilm as $rowFilm) { ?>
                            <div class="col-lg-4 mb-5">
                                <h6 class="mb-3"><?php echo $rowFilm["titolo"]; ?></h6>
                                <a class="d-block rounded-lg lift lift-lg" href="<?= "view.php?id=" . $rowFilm["id"]?>"><img class="img-fluid rounded-lg" src="<?= "resources/" . $rowFilm["id"] . "/anteprima.jpg"?>"/></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                    </div>
                </section>
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-light footer-light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-brand">InstantFlow</div>
                            <div class="icon-list-social mb-5">
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-instagram"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-facebook"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-github"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Product</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Landing</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Pages</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Sections</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Documentation</a></li>
                                        <li><a href="javascript:void(0);">Changelog</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Technical</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Documentation</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Changelog</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Theme Customizer</a></li>
                                        <li><a href="javascript:void(0);">UI Kit</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Includes</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Utilities</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Components</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Layouts</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Code Samples</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Products</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Affiliates</a></li>
                                        <li><a href="javascript:void(0);">Updates</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="text-uppercase-expanded text-xs mb-4">Legal</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Privacy Policy</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Terms and Conditions</a></li>
                                        <li><a href="javascript:void(0);">License</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row align-items-center">
                        <div class="col-md-6 small">Copyright &copy; InstantFlow 2021</div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Privacy Policy</a>
                            &middot;
                            <a href="javascript:void(0);">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
</body>
