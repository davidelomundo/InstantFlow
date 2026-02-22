<?php
session_start();

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
                                    <h1 class="page-header-title mb-3">Pricing</h1>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-light pt-10">
                    <div class="svg-border-waves text-dark">
                        <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 75">
                            <defs>
                                <style>
                                    .a {
                                        fill: none;
                                    }

                                    .b {
                                        clip-path: url(#a);
                                    }

                                    .d {
                                        opacity: 0.5;
                                        isolation: isolate;
                                    }
                                </style>
                                <clippath id="a">
                                    <rect class="a" width="1920" height="75"></rect>
                                </clippath>
                            </defs>
                        </svg>
                    </div>
                </section>
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-brand">InstantFlow</div>
                            <div class="icon-list-social mb-5">
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-facebook"></i></a>
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-github"></i></a>
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Product</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Landing</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Pages</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Sections</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Documentation</a></li>
                                        <li><a href="javascript:void(0);">Changelog</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Technical</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Documentation</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Changelog</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Theme Customizer</a></li>
                                        <li><a href="javascript:void(0);">UI Kit</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Includes</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Utilities</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Components</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Layouts</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Code Samples</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Products</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Affiliates</a></li>
                                        <li><a href="javascript:void(0);">Updates</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="text-uppercase-expanded text-xs mb-4">Legal</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Privacy Policy</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Terms and Conditions</a></li>
                                        <li><a href="javascript:void(0);">License</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row align-items-center">
                        <div class="col-md-6 small">Copyright &copy; InstantFlow <?php echo date('Y'); ?></div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Privacy Policy</a>
                            &middot;
                            <a href="javascript:void(0);">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <?php 
        $footerTheme = 'dark';
        include "includes/footer.php"; 
        ?>