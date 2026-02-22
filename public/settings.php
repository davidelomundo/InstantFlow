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

if (isset($_POST["firstName"]) && !empty($_POST["firstName"]) && isset($_POST["lastName"]) && !empty($_POST["lastName"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
    $user->id = $_SESSION["userId"];
    $user->firstName = $_POST["firstName"];
    $user->lastName = $_POST["lastName"];
    $user->email = $_POST["email"];
    $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $user->updateUser();

    header("Location: logged.php");
    exit;
}

$user->id = $_SESSION["userId"];
$rowUser = $user->getInfo();

require_once "includes/head.php";

// Set navbar parameters
$isLoggedIn = true;
$userInfo = $rowUser;
$dropdownText = $rowUser["first_name"];
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
                                    <h1 class="page-header-title mb-3">Settings</h1>
                                    <p class="page-header-text">Manage your account information easily.</p>
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
                <section class="bg-light py-5">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <div class="card rounded-lg text-dark" data-aos="fade-up">
                                    <div class="card-header py-4">Update Information</div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-6"><label class="small text-gray-600" for="leadCapFirstName">First Name</label><input class="form-control rounded-pill" id="leadCapFirstName" name="firstName" type="text" value="<?php echo $rowUser["first_name"]; ?>" /></div>
                                                <div class="form-group col-md-6"><label class="small text-gray-600" for="leadCapLastName">Last Name</label><input class="form-control rounded-pill" id="leadCapLastName" name="lastName" type="text" value="<?php echo $rowUser["last_name"]; ?>" /></div>
                                            </div>
                                            <div class="form-group"><label class="small text-gray-600" for="leadCapEmail">Email</label><input class="form-control rounded-pill" id="leadCapEmail" name="email" type="email" value="<?php echo $rowUser["email"]; ?>" /></div>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-primary btn-marketing btn-block rounded-pill mt-4" type="submit">Update</button>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-danger btn-marketing btn-block rounded-pill mt-4" href="delete.php">Delete Account</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-light py-5">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <div class="card rounded-lg text-dark" data-aos="fade-up">
                                    <div class="card-header py-4">Change Password</div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-group"><label class="small text-gray-600" for="inputCurrentPassword">Current Password</label><input class="form-control rounded-pill" id="inputCurrentPassword" name="currentPassword" type="password" /></div>
                                            <div class="form-group"><label class="small text-gray-600" for="inputNewPassword">New Password</label><input class="form-control rounded-pill" id="inputNewPassword" name="newPassword" type="password" /></div>
                                            <div class="form-group"><label class="small text-gray-600" for="inputConfirmPassword">Confirm Password</label><input class="form-control rounded-pill" id="inputConfirmPassword" name="confirmPassword" type="password" /></div>
                                            <button class="btn btn-primary btn-marketing btn-block rounded-pill mt-4" type="submit">Change Password</button>
                                        </form>
                                    </div>
                                </div>
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