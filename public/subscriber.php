<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\User;
use App\Models\Subscription;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$subscription = new Subscription($db);

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

if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $user->id = $_SESSION["userId"];
    $user->firstName = $_POST["firstName"];
    $user->lastName = $_POST["lastName"];
    $user->email = $_POST["email"];
    $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $user->updateUser();

    header("Location: logged.php");
    exit;
}

require_once "includes/head.php";

$user->id = $_SESSION["userId"];
$rowUser = $user->getInfo();

$subscription->userId = $_SESSION["userId"];
$rowSubscription = $subscription->getExpiration();

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
                                    <h1 class="page-header-title mb-3">Subscription</h1>
                                    <p class="page-header-text">Here you can see your subscription expiration at any time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="bg-light py-10">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col align-self-center">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i class="bi bi-calendar"></i></div>
                                <h3>Expiration</h3>
                                <p class="mb-0">Your subscription expires on <?php echo date("d/m/Y", strtotime($rowSubscription["expiration"])); ?>.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <?php 
        $enableAOS = true;
        include "includes/footer.php"; 
        ?>
