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
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            Actors
                        </h1>
                        <div class="page-header-subtitle">Here you will find the tools needed to manage actors</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-n10">
        <div class="card mb-4">
            <div class="card-header">New Actor</div>
            <div class="card-body">
                <form method="POST">
                    <!-- Form Row-->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputFirstName">First Name</label>
                            <input class="form-control" id="inputFirstName" type="text" value="" name="firstName" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputLastName">Last Name</label>
                            <input class="form-control" id="inputLastName" type="text" value="" name="lastName" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>