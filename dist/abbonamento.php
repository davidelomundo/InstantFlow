<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/abbonamento.php";
require_once "../class/categoria.php";

$database = new Database();
$db = $database->getConnection();
$abbonamento = new Abbonamento($db);
$categoria = new Categoria($db);

$stmtCategoria = $categoria->getCategory();

$abbonamento->idUtente = $_SESSION["idUtente"];
if($abbonamento->isSubscribed()) {
    header("Location: logged.php");
}
?>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand text-white" href="index.php">InstantFlow</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">
                                <li class="nav-item"><a class="nav-link" href="index.php">Home </a></li>
                                <li class="nav-item"><a class="nav-link" href="pricing.php">Prezzi</a></li>
                            </ul>
                            <a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="login.php">Accedi<i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </nav>                    
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-content pt-10">
                        <div class="container text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="page-header-title mb-3">Abbonati</h1>
                                    <p class="page-header-text">Tre tipologie di abbonamento per ogni necessità.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                    </div>
                </header>
                <section class="bg-light py-10">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2>Prezzi semplici</h2>
                        </div>
                        <form method="POST" action="checkout.php">
                            <div class="row no-gutters align-items-center">
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="card pricing pricing-left">
                                        <div class="card-body p-5">
                                            <div class="text-center">
                                                <div class="badge badge-light badge-pill badge-marketing badge-sm">Basic</div>
                                                <div class="pricing-price"><sup>€</sup>7,99<span class="pricing-price-period">/mese</span></div>
                                            </div>
                                            <ul class="fa-ul pricing-list">
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">1 dispositivo</span>
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
                                                <div class="pricing-price"><sup>€</sup>9,99<span class="pricing-price-period">/mese</span></div>
                                            </div>
                                            <ul class="fa-ul pricing-list">
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">2 dispositivi</span>
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
                                                <div class="pricing-price"><sup>€</sup>14,99<span class="pricing-price-period">/mese</span></div>
                                            </div>
                                            <ul class="fa-ul pricing-list">
                                                <li class="pricing-list-item">
                                                    <span class="fa-li"><i class="far fa-check-circle text-teal"></i></span><span class="text-dark">4 dispositivi</span>
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
                            <div class="mt-5 text-center"><input type="submit" class="btn btn-primary btn-marketing rounded-pill" value="Abbonati"></div>
                        </form>
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
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-instagram"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-facebook"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-github"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
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
                        <div class="col-md-6 small">Copyright &copy; InstantFlow 2021</div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Privacy Policy</a>
                            &middot;
                            <a href="javascript:void(0);">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>