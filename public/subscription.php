<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\Subscription;
use App\Models\Category;

$database = new Database();
$db = $database->getConnection();
$subscription = new Subscription($db);
$category = new Category($db);

$stmtCategory = $category->getCategories();

$subscription->userId = $_SESSION["userId"];
if ($subscription->isSubscribed()) {
    header("Location: logged.php");
    exit;
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
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-content pt-10">
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="page-header-title mb-3">Subscribe</h1>
                                    <p class="page-header-text">Three subscription plans for every need.</p>
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
                        <div class="text-center mb-5">
                            <h2>Simple Pricing</h2>
                        </div>
                        <form method="POST" action="checkout.php">
                            <div class="row no-gutters align-items-center">
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="card pricing pricing-left">
                                        <div class="card-body p-5">
                                            <div class="text-center">
                                                <div class="badge badge-light badge-pill badge-marketing badge-sm">Basic</div>
                                                <div class="pricing-price"><sup>€</sup>7.99<span class="pricing-price-period">/month</span></div>
                                            </div>
                                            <ul class="fa-ul pricing-list">
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">1 device</span>
                                                </li>
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">720p</span>
                                                </li>
                                            </ul>
                                            <div class="mt-5 text-center"><input type="radio" class="btn btn-primary-outlined btn-marketing rounded-pill" name="idCategoria" value="1" checked></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="card pricing py-4 z-1">
                                        <div class="card-body p-5">
                                            <div class="text-center">
                                                <div class="badge badge-primary-soft badge-pill badge-marketing badge-sm text-primary">Plus</div>
                                                <div class="pricing-price"><sup>€</sup>9.99<span class="pricing-price-period">/month</span></div>
                                            </div>
                                            <ul class="fa-ul pricing-list">
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">2 devices</span>
                                                </li>
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">1080p</span>
                                                </li>
                                            </ul>
                                            <div class="mt-5 text-center"><input type="radio" class="btn btn-primary-outlined btn-marketing rounded-pill" name="idCategoria" value="2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="card pricing pricing-right">
                                        <div class="card-body p-5">
                                            <div class="text-center">
                                                <div class="badge badge-secondary-soft badge-pill badge-marketing badge-sm text-secondary">Pro</div>
                                                <div class="pricing-price"><sup>€</sup>14.99<span class="pricing-price-period">/month</span></div>
                                            </div>
                                            <ul class="fa-ul pricing-list">
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">4 devices</span>
                                                </li>
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">2160p</span>
                                                </li>
                                            </ul>
                                            <div class="mt-5 text-center"><input type="radio" class="btn btn-primary-outlined btn-marketing rounded-pill" name="idCategoria" value="3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 text-center"><input type="submit" class="btn btn-primary btn-marketing rounded-pill" value="Subscribe"></div>
                        </form>
                    </div>
                </section>
            </main>
        </div>
        <div id="layoutDefault_footer">
            <?php include "includes/footer.php"; ?>
        </div>
