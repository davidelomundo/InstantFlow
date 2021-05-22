<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

if(isset($_SESSION["idUtente"]) && !empty($_SESSION["idUtente"])) {
  header("Location: logged.php");
}

if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
    $utente->email = $_POST["email"];
    $utente->password = $_POST["password"];
    
    $_SESSION["idUtente"] = $utente->loginUser();

    if(!empty($_SESSION["idUtente"])) {
        header("Location: logged.php");
    }
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
                                <a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="signup.php">Iscriviti<i class="fas fa-arrow-right ml-1"></i></a>
                            </ul>
                        </div>
                    </div>
                </nav>
                <header class="page-header page-header-dark bg-img-repeat bg-secondary" style='background-image: url("assets/img/pattern-shapes.png")'>
                    <div class="page-header-content">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h1 class="page-header-title">Esegui l'accesso per accedere al catalogo</h1>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card rounded-lg text-dark" data-aos="fade-up">
                                        <div class="card-header py-4">Accesso</div>
                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-group"><label class="small text-gray-600" for="leadCapEmail">Email</label><input class="form-control rounded-pill" id="leadCapEmail" name="email" type="email" /></div>
                                                <div class="form-group"><label class="small text-gray-600" for="leadCapCompany">Password</label><input class="form-control rounded-pill" id="leadCapCompany" name="password" type="password" /></div>
                                                <button class="btn btn-primary btn-marketing btn-block rounded-pill mt-4" type="submit">Accedi</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-angled text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor"><polygon points="0,100 100,0 100,100"></polygon></svg>
                    </div>
                </header>
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
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
</body>
