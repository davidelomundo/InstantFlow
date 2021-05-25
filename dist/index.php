<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";

$database = new Database();
$db = $database->getConnection();

$utente = new Utente($db);
$film = new Film($db);

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
                                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="pricing.php">Prezzi</a></li>
                            </ul>
                            <a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="login.php">Accedi<i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </nav>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-content pt-10">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6" data-aos="fade-up">
                                    <h1 class="page-header-title">Benvenuto su InstantFlow</h1>
                                    <p class="page-header-text mb-5">Benvenuto su InstantFlow, la nuova piattaforma streaming che ti darà accesso ad un catalogo di film straordinari.</p>
                                    <a class="btn btn-teal btn-marketing rounded-pill lift lift-sm" href="login.php">Accedi<i class="fas fa-arrow-right ml-1"></i></a><a class="btn btn-link btn-marketing" href="signup.php">Iscriviti</a>
                                </div>
                                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="50"><img class="img-fluid" src="assets/img/ciak.png" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                    </div>
                </header>
                <section class="bg-white py-10">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="layers"></i></div>
                                <h3>Raccolta</h3>
                                <p class="mb-0">La nostra raccolta di film sempre in espansione.</p>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i class="bi bi-play-btn"></i></div>
                                <h3>Accesso istantaneo</h3>
                                <p class="mb-0">Accedi istantaneamente al film che preferisci dove e quando vuoi.</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i class="bi bi-badge-4k"></i></div>
                                <h3>Risoluzione 4K</h3>
                                <p class="mb-0">Goditi i tuoi film preferiti fino alla risoluzione 4K.</p>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                    </div>
                </section>
                <section class="bg-light py-10">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="text-center mb-10">
                                    <h2>I nostri traguardi</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 text-center mb-5">
                                <div class="display-1 font-weight-bold text-gray-400"><?php echo $utente->count()["count"]; ?>+</div>
                                <div class="h5">Utenti iscritti</div>
                                <p>We've extended and restyled Bootstrap's default components, and built a suite of new custom components.</p>
                            </div>
                            <div class="col-lg-4 text-center mb-5">
                                <div class="display-1 font-weight-bold text-gray-400"><?php echo $film->count()["count"]; ?>+</div>
                                <div class="h5">Film disponibili</div>
                                <p>Our pre-built page examples are a perfect way to get inspired for creating new pages and views.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-light pt-10">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2>Prezzi semplici</h2>
                        </div>
                        <div class="row z-1">
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up">
                                <div class="card pricing h-100">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br><br>
                    </div>
                    <div class="svg-border-rounded text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                    </div>
                </section>
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-white footer-light">
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
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
</body>
