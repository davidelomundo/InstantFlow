<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;
use App\Models\Film;
use App\Models\Subscription;
use App\Models\User;

$database = new Database();
$db = $database->getConnection();
$film = new Film($db);
$subscription = new Subscription($db);
$user = new User($db);

if (!isset($_SESSION["userId"]) || empty($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
} else {
    $subscription->userId = $_SESSION["userId"];
    if (!$subscription->isSubscribed()) {
        header("Location: subscription.php");
        exit;
    }
}

require_once "includes/head.php";

if (isset($_GET["ricerca"]) && !empty($_GET["ricerca"])) {
    $film->title = $_GET["ricerca"];
    $stmtFilm = $film->findFilms();
} else {
    $stmtFilm = $film->getFilms();
}

$user->id = $_SESSION["userId"];
$rowUser = $user->getInfo();

$stmtCronologia = $user->history()->fetchAll();

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
                                    <h1 class="page-header-title mb-3">History</h1>
                                    <p class="page-header-text">Your growing collection, updated daily.</p>
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
                        <?php if (empty($stmtCronologia)) { ?>
                            <div class="text-center py-5">
                                <i class="bi bi-clock-history" style="font-size: 3rem; color: #6c757d;"></i>
                                <h4 class="mt-3 text-gray-500">No history yet</h4>
                                <p class="text-gray-500">Films you watch will appear here.</p>
                            </div>
                        <?php } else { ?>
                            <div class="row">
                                <?php foreach ($stmtCronologia as $rowCronologia) {
                                    $film->id = $rowCronologia["film_id"];
                                    $rowFilm = $film->getById(); ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-5">
                                        <a class="card lift h-100" href="<?= "view.php?id=" . $rowFilm["id"] ?>">
                                            <img class="card-img-top" src="<?= "/resources/" . $rowFilm["id"] . "/preview.jpg" ?>" alt="Preview" />
                                            <div class="card-body p-3">
                                                <div class="card-title small mb-0"></div>
                                                <div class="text-xs text-black-500"><?php echo $rowFilm["title"]; ?></div>
                                                <div class="text-xs text-gray-500"><?php echo date('d/m/Y H:i ', strtotime($rowCronologia["watched_at"] . ' + 1 hours')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>
            </main>
        </div>

        <?php
        $enableAOS = true;
        include "includes/footer.php";
        ?>