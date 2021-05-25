<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";

if(empty($_SESSION["idAdmin"])) {
    header("Location: login.php");
}

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

$utente->id = $_SESSION["idAdmin"];
$rowUtente = $utente->getInfo();

?>

    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Navbar Brand-->
            <!-- * * Tip * * You can use text or an image for your navbar brand.-->
            <!-- * * * * * * When using an image, we recommend the SVG format.-->
            <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
            <a class="navbar-brand" href="index.php">InstantFlow</a>
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ml-auto">
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?php echo $rowUtente["nome"] . " " . $rowUtente["cognome"]; ?></div>
                                <div class="dropdown-user-details-email"><?php echo $rowUtente["email"]; ?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="destruct.php">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Esci
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- Sidenav Heading (App Views)-->
                            <div class="sidenav-menu-heading">Altro</div>
                            <!-- Sidenav Link (Tables)-->
                            <a class="nav-link" href="index.php">
                                <div class="nav-link-icon"><i class="bi bi-collection"></i></div>
                                Principale
                            </a>
                            <!-- Sidenav Menu Heading (Strumenti)-->
                            <div class="sidenav-menu-heading">Strumenti</div>
                            <!-- Sidenav Accordion (Azioni)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                <div class="nav-link-icon"><i class="bi bi-tools"></i></div>
                                Azioni
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link" href="film.php">Film</a>
                                    <a class="nav-link" href="admin.php">Admin</a>
                                </nav>
                            </div>
                            <!-- Sidenav Heading (App Views)-->
                            <div class="sidenav-menu-heading">Area personale</div>
                            <!-- Sidenav Link (Tables)-->
                            <a class="nav-link" href="account.php">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                Account
                            </a>
                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Collegato come:</div>
                            <div class="sidenav-footer-title"><?php echo $rowUtente["nome"] . " " . $rowUtente["cognome"]; ?></div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
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
                    <!-- Main page content-->
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-xl">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                        <form>
                                            <!-- Form Row-->
                                            <div class="form-row">
                                                <!-- Form Group (first name)-->
                                                <div class="form-group col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">Nome</label>
                                                    <input class="form-control" id="inputFirstName" type="text" value="<?php echo $rowUtente["nome"]; ?>" />
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="form-group col-md-6">
                                                    <label class="small mb-1" for="inputLastName">Cognome</label>
                                                    <input class="form-control" id="inputLastName" type="text" value="<?php echo $rowUtente["cognome"]; ?>" />
                                                </div>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control" id="inputEmailAddress" type="email" value="<?php echo $rowUtente["email"]; ?>" />
                                            </div>
                                            <div class="form-row">
                                                <!-- Form Group (first name)-->
                                                <div class="form-group col-md-6 mt-2">
                                                    <button class="btn btn-primary" type="button">Salva</button>
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="form-group col-md-3 mt-2">
                                                    <a class="btn btn-danger" type="button" href="delete.php">Elimina account</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="footer mt-auto footer-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; InstantFlow 2021</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/date-range-picker-demo-single.js"></script>
    </body>
