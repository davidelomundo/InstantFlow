<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\User;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if (isset($_POST["firstName"]) && !empty($_POST["firstName"]) && isset($_POST["lastName"]) && !empty($_POST["lastName"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"])) {
    if ($_POST["password"] === $_POST["confirmPassword"]) {
        $user->firstName = $_POST["firstName"];
        $user->lastName = $_POST["lastName"];
        $user->email = $_POST["email"];
        $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $user->createUser();
        $user->email = $_POST["email"];
        $user->password = $_POST["password"];
        $_SESSION["userId"] = $user->loginUser();

        header('Location: abbonamento.php');
        exit;
    }
}

require_once "includes/head.php";

// Set navbar parameters
$isLoggedIn = false;

?>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <?php include "includes/navbar.php"; ?>
                <header class="page-header page-header-dark bg-img-repeat bg-secondary" style='background-image: url("assets/img/pattern-shapes.png")'>
                    <div class="page-header-content">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h1 class="page-header-title">Sign up to access the catalog</h1>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card rounded-lg text-dark" data-aos="fade-up">
                                        <div class="card-header py-4">Sign Up</div>
                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="small text-gray-600" for="leadCapFirstName">First Name</label>
                                                        <input class="form-control rounded-pill" id="leadCapFirstName" name="firstName" type="text" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="small text-gray-600" for="leadCapLastName">Last Name</label>
                                                        <input class="form-control rounded-pill" id="leadCapLastName" name="lastName" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="small text-gray-600" for="leadCapEmail">Email</label>
                                                    <input class="form-control rounded-pill" id="leadCapEmail" name="email" type="email" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="small text-gray-600" for="leadCapCompany">Password</label>
                                                    <input class="form-control rounded-pill" id="leadCapCompany" name="password" type="password" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="small text-gray-600" for="leadCapCompany">Confirm Password</label>
                                                    <input class="form-control rounded-pill" id="leadCapCompany" name="confirmPassword" type="password" />
                                                </div>
                                                <button class="btn btn-primary btn-marketing btn-block rounded-pill mt-4" type="submit">Sign Up</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-angled text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor">
                            <polygon points="0,100 100,0 100,100"></polygon>
                        </svg>
                    </div>
                </header>
            </main>
        </div>
        <div id="layoutDefault_footer">
            <?php 
            $enableAOS = true;
            $footerTheme = 'dark';
            include "includes/footer.php"; 
            ?>
        </div>