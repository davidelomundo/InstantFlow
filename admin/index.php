<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;
use App\Models\User;

if (empty($_SESSION["idAdmin"])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id = $_SESSION["idAdmin"];
$rowUser = $user->getInfo();

require_once "includes/head.php";
include "includes/navbar.php";
?>

<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <?php echo "Welcome " . $rowUser["first_name"]; ?>
                        </h1>
                        <div class="page-header-subtitle">Manage your content, users, and platform settings</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-n10">
        <div class="row">
            <div class="col col-xl-12 mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-12">
                                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-primary">Welcome to the dashboard!</h1>
                                    <p class="text-gray-700 mb-0">In this section you will find everything you need.</p>
                                    <div class="col-xl-4 col-xxl-12 text-center mt-3"><img class="img-fluid" src="assets/img/illustrations/data-report.svg" style="max-width: 26rem" /></div>
                                    <a class="btn btn-primary p-3 mt-5" href="index.php">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>