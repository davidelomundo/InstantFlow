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
                <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                    <div class="container-fluid">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="user"></i></div>
                                        Account
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-xl">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Update Details</div>
                                <div class="card-body">
                                    <form>
                                        <!-- Form Row-->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="small mb-1" for="inputFirstName">First Name</label>
                                                <input class="form-control" id="inputFirstName" type="text" value="<?php echo $rowUser["first_name"]; ?>" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="small mb-1" for="inputLastName">Last Name</label>
                                                <input class="form-control" id="inputLastName" type="text" value="<?php echo $rowUser["last_name"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" value="<?php echo $rowUser["email"]; ?>" />
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mt-2">
                                                <button class="btn btn-primary" type="button">Save</button>
                                            </div>
                                            <div class="form-group col-md-3 mt-2">
                                                <a class="btn btn-danger" type="button" href="delete.php">Delete Account</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "includes/footer.php"; ?>