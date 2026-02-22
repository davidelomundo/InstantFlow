<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\User;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Subscription;

$database = new Database();
$db = $database->getConnection();
$film = new Film($db);
$genre = new Genre($db);
$subscription = new Subscription($db);

if (!isset($_SESSION["userId"]) || empty($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
} else {
    $subscription->userId = $_SESSION["userId"];
    if (!$subscription->isSubscribed()) {
        header("Location: abbonamento.php");
        exit;
    }
}

require_once "includes/head.php";
$user = new User($db);
$stmtFilm = $film->getFilms();
$stmtGenere = $genre->getGenres();

$user->id = $_SESSION["userId"];
$rowUtente = $user->getInfo();
?>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand text-white" href="logged.php">InstantFlow</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">
                                <li class="nav-item dropdown no-caret">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $rowUtente["first_name"]; ?><i class="fas fa-chevron-right dropdown-arrow"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                                        <a class="dropdown-item py-3" href="settings.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-gear"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Settings</div>
                                                Manage your account
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="abbonato.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-credit-card-2-front-fill"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Subscription</div>
                                                Check or renew your subscription
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="history.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-clock-history"></i></div>
                                            <div>
                                                <div class="small text-gray-500">History</div>
                                                Recently watched films
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="destruct.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-power"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Logout</div>
                                                Sign out
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="generi.php">Genres</a></li>
                            </ul>
                            <form action="logged.php" method="GET" class="d-flex align-items-center">
                                <div class="form-row align-items-center justify-content-center">
                                    <div>
                                        <div class="form-group mb-0 mr-0 mr-lg-2">
                                            <label class="sr-only" for="inputSearch">Search...</label>
                                            <input class="form-control form-control-solid rounded-pill" id="inputSearch" name="ricerca" type="text" placeholder="Search..." />
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn-teal btn rounded-pill px-4 ml-lg-4" type="submit">Search</button>
                                    </div>
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
                                    <h1 class="page-header-title mb-3">Genres</h1>
                                    <p class="page-header-text">Your collection filtered by genre.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </header>

                <section class="bg-light py-10">
                    <div class="container">
                        <?php foreach ($stmtGenere as $genre) {
                            $stmtFilm = $film->getFilmsByGenre($genre["id"]);
                        ?>
                            <h2 class="mb-4"><?php echo $genre["name"]; ?></h2>
                            <div class="row">
                                <?php foreach ($stmtFilm as $rowFilm) { ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                                        <a class="card lift h-100" href="<?= "view.php?id=" . $rowFilm["id"] ?>">
                                            <img class="card-img-top" src="<?= "../resources/" . $rowFilm["id"] . "/anteprima.jpg" ?>" alt="Preview" />
                                            <div class="card-body p-3">
                                                <div class="card-title small mb-0"></div>
                                                <div class="text-xs text-black-500"><?php echo $rowFilm["title"]; ?></div>
                                                <div class="text-xs text-gray-500"><?php echo date('d/m/Y', strtotime($rowFilm["release_date"])); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </main>
        </div>

        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-brand">InstantFlow</div>
                            <div class="icon-list-social mb-5">
                                <a class="icon-list-social-link" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="icon-list-social-link" href="#"><i class="fab fa-facebook"></i></a>
                                <a class="icon-list-social-link" href="#"><i class="fab fa-github"></i></a>
                                <a class="icon-list-social-link" href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Product</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="#">Landing</a></li>
                                        <li class="mb-2"><a href="#">Pages</a></li>
                                        <li class="mb-2"><a href="#">Sections</a></li>
                                        <li class="mb-2"><a href="#">Documentation</a></li>
                                        <li><a href="#">Changelog</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Technical</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="#">Documentation</a></li>
                                        <li class="mb-2"><a href="#">Changelog</a></li>
                                        <li class="mb-2"><a href="#">Theme Customizer</a></li>
                                        <li><a href="#">UI Kit</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Includes</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="#">Utilities</a></li>
                                        <li class="mb-2"><a href="#">Components</a></li>
                                        <li class="mb-2"><a href="#">Layouts</a></li>
                                        <li class="mb-2"><a href="#">Code Samples</a></li>
                                        <li class="mb-2"><a href="#">Products</a></li>
                                        <li class="mb-2"><a href="#">Affiliates</a></li>
                                        <li><a href="#">Updates</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="text-uppercase-expanded text-xs mb-4">Legal</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                                        <li class="mb-2"><a href="#">Terms and Conditions</a></li>
                                        <li><a href="#">License</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row align-items-center">
                        <div class="col-md-6 small">Copyright &copy; InstantFlow <?php echo date('Y'); ?></div>
                        <div class="col-md-6 text-md-right small">
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>