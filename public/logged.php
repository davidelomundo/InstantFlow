<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\User;
use App\Models\Film;
use App\Models\Subscription;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$movie = new Film($db);
$subscription = new Subscription($db);

// Check if user is logged in
if (!isset($_SESSION["userId"]) || empty($_SESSION["userId"])) {
    header("Location: login.php");
    exit;
}

// Check subscription
$subscription->userId = $_SESSION["userId"];
if (!$subscription->isSubscribed()) {
    header("Location: abbonamento.php");
    exit;
}

// Get user info
$user->id = $_SESSION["userId"];
$userInfo = $user->getInfo();

require_once "includes/head.php";   

if(isset($_GET["ricerca"]) && !empty($_GET["ricerca"])) {
    $movie->title= $_GET["ricerca"];
    $stmtFilm = $movie->findFilms();
} else {
    $stmtFilm = $movie->getFilms();
}

// Set navbar parameters
$isLoggedIn = true;
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
                                    <h1 class="page-header-title mb-3">Collection</h1>
                                    <p class="page-header-text">Your collection expanding every day.</p>
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
                                <h6 class="mb-3"><?php echo $rowFilm["title"]; 
                                $filmPath = "../resources/" . $rowFilm["id"] . "/film.mp4";
                                if(file_exists($filmPath) && filesize($filmPath)/(1024*1000)>200) { ?>
                                    <i class="bi bi-badge-4k text-purple"></i>
                                <?php } ?>
                                </h6>
                                <a class="d-block rounded-lg lift lift-lg" href="<?= "view.php?id=" . $rowFilm["id"]?>"><img class="img-fluid rounded-lg" src="<?= "../resources/" . $rowFilm["id"] . "/anteprima.jpg"?>"/></a>
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
        <?php 
        $enableAOS = true;
        include "includes/footer.php"; 
        ?>
