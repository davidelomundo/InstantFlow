<?php
session_start();

require_once "includes/head.php";

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\User;
use App\Models\Subscription;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$subscription = new Subscription($db);

if (!isset($_SESSION["idUtente"]) || empty($_SESSION["idUtente"])) {
    header("Location: index.php");
} else {
    $subscription->userId = $_SESSION["idUtente"];
    if (!$subscription->isSubscribed()) {
        header("Location: abbonamento.php");
    }
}

if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $user->id = $_SESSION["idUtente"];
    $user->firstName = $_POST["firstName"];
    $user->lastName = $_POST["lastName"];
    $user->email = $_POST["email"];
    $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $user->updateUser();

    header("Location: logged.php");
}

$user->id = $_SESSION["userId"];
$rowUser = $user->getInfo();

$subscription->userId = $_SESSION["userId"];
$rowSubscription = $subscription->getExpiration();
?>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand text-white" href="logged.php">InstantFlow</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                            <i data-feather="menu"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">
                                <li class="nav-item dropdown no-caret">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown"><?php echo $rowUser["first_name"]; ?><i class="fas fa-chevron-right dropdown-arrow"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in-up">
                                        <a class="dropdown-item py-3" href="settings.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-gear"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Settings</div>
                                                Manage your account data
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="abbonato.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-credit-card-2-front-fill"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Subscription</div>
                                                Check expiry or renew your subscription
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="history.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-clock-history"></i></div>
                                            <div>
                                                <div class="small text-gray-500">History</div>
                                                The history of the last movies you watched
                                            </div>
                                        </a>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item py-3" href="destruct.php">
                                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="bi bi-power"></i></div>
                                            <div>
                                                <div class="small text-gray-500">Logout</div>
                                                Log out from the platform
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="generi.php">Genres</a></li>
                            </ul>
                            <form action="logged.php">
                                <div class="form-row justify-content-center">
                                    <div>
                                        <div class="form-group mr-0 mr-lg-2">
                                            <label class="sr-only" for="inputSearch">Search...</label>
                                            <input class="form-control form-control-solid rounded-pill" id="inputSearch" name="ricerca" type="text" placeholder="Search..." />
                                        </div>
                                    </div>
                                    <div><button class="btn-teal btn rounded-pill px-4 ml-lg-4" type="submit">Search</button></div>
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
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-light footer-light">
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
                        <div class="col-md-6 small">Copyright &copy; InstantFlow 2026</div>
                        <div class="col-md-6 text-md-right small">
                            <a href="#">Privacy Policy</a> &middot; <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
</body>