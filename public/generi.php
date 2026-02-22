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
$rowUser = $user->getInfo();

// Set navbar parameters
$isLoggedIn = true;
$userInfo = $rowUser;
$showSearch = true;
$searchAction = 'logged.php';
?>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <?php include "includes/navbar.php"; ?>

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

        <?php 
        $footerTheme = 'dark';
        include "includes/footer.php"; 
        ?>