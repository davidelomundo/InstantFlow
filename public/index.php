<?php
session_start();

require_once "includes/head.php";

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;
use App\Models\User;
use App\Models\Film;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$movie = new Film($db);

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
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6" data-aos="fade-up">
                                    <h1 class="page-header-title">Welcome to InstantFlow</h1>
                                    <p class="page-header-text mb-5">Welcome to InstantFlow, the new streaming platform giving you access to an amazing movie catalog.</p>
                                    <a class="btn btn-teal btn-marketing rounded-pill lift lift-sm" href="login.php">Login<i class="fas fa-arrow-right ml-1"></i></a>
                                    <a class="btn btn-link btn-marketing" href="signup.php">Sign Up</a>
                                </div>
                                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="50"><img class="img-fluid" src="assets/img/ciak.png" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </header>
                <section class="bg-white py-10">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="layers"></i></div>
                                <h3>Collection</h3>
                                <p class="mb-0">Our ever-growing collection of movies.</p>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i class="bi bi-play-btn"></i></div>
                                <h3>Instant Access</h3>
                                <p class="mb-0">Access your favorite movie instantly, anytime, anywhere.</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i class="bi bi-badge-4k"></i></div>
                                <h3>4K Resolution</h3>
                                <p class="mb-0">Enjoy your favorite movies up to 4K resolution.</p>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>
                <section class="bg-light py-10">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="text-center mb-10">
                                    <h2>Our Achievements</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 text-center mb-5">
                                <div class="display-1 font-weight-bold text-gray-400"><?php echo $user->count()["count"]; ?>+</div>
                                <div class="h5">Registered Users</div>
                                <p>The number of users registered on the platform will be limited until the official launch.</p>
                            </div>
                            <div class="col-lg-4 text-center mb-5">
                                <div class="display-1 font-weight-bold text-gray-400"><?php echo $movie->count()["count"]; ?>+</div>
                                <div class="h5">Available Movies</div>
                                <p>Hundreds of titles are planned for the launch.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-light pb-10">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2>Simple Pricing</h2>
                        </div>
                        <div class="row z-1">
                            <div class="col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-5" data-aos="fade-up">
                                <div class="card pricing h-100">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-white">
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