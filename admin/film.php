<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/utente.php";
require_once "../class/film.php";
require_once "../class/genere.php";

if(empty($_SESSION["idAdmin"])) {
    header("Location: login.php");
}

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);
$film = new Film($db);
$genere = new Genere($db);

$utente->id = $_SESSION["idAdmin"];
$rowUtente = $utente->getInfo();

$stmtFilm = $film->getFilms();

if(isset($_GET["idFilm"]) && !empty($_GET["idFilm"])) {
    $film->id = $_GET["idFilm"];
    $film->delete();
}

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
                                    <a class="nav-link" href="attore.php">Attori</a>
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
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                                            Film
                                        </h1>
                                        <div class="page-header-subtitle">Qui troverai gli strumenti necessari per la gestione dei film</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container mt-n10">
                        <div class="row mb-4">
                            <div class="col-xl-6 mb-4">
                                <div class="card card-header-actions h-100">
                                    <div class="card-header">
                                        Guadagni mensili
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 mb-4">
                                <!-- Pie chart with legend example-->
                                <div class="card h-100">
                                    <div class="card-header">Generi</div>
                                    <div class="card-body">
                                    <div class="chart-pie mb-4"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">Film</div>
                            <div class="card-body">
                                <div class="datatable">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Titolo</th>
                                                <th>Descrizione</th>
                                                <th>Data uscita</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Titolo</th>
                                                <th>Descrizione</th>
                                                <th>Data uscita</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach($stmtFilm as $rowFilm) { ?>
                                            <tr>
                                                <td><?php echo $rowFilm["titolo"]; ?></td>
                                                <td><?php echo $rowFilm["descrizione"]; ?></td>
                                                <td><?php echo date("d/m/Y", strtotime(date($rowFilm["dataUscita"]))); ?></td>
                                                <td>
                                                    <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                                    <a type="button" class="btn btn-datatable btn-icon btn-transparent-dark" href="<?= "?idFilm=" . $rowFilm["id"] ?>"><i data-feather="trash-2"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">Nuovo film</div>
                            <div class="card-body">
                                <form>
                                    <!-- Form Row-->
                                    <div class="form-row">
                                        <!-- Form Group (first name)-->
                                        <div class="form-group col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Nome</label>
                                            <input class="form-control" id="inputFirstName" type="text" value="" />
                                        </div>
                                        <!-- Form Group (last name)-->
                                        <div class="form-group col-md-6">
                                            <label class="small mb-1" for="inputLastName">Descrizione</label>
                                            <input class="form-control" id="inputLastName" type="text" value="" />
                                        </div>
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Data uscita</label>
                                        <input class="form-control" id="inputEmailAddress" type="date" value="" />
                                    </div>
                                    <!-- Form Group (email address)-->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="small mb-1" for="inputEmailAddress">Anteprima</label>
                                            <input class="form-control" id="inputEmailAddress" type="file" value="" />
                                        </div>
                                        <!-- Form Group (email address)-->
                                        <div class="form-group col-md-6">
                                            <label class="small mb-1" for="inputEmailAddress">Contenuto</label>
                                            <input class="form-control" id="inputEmailAddress" type="file" value="" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- Form Group (first name)-->
                                        <div class="form-group col-md-6 mt-2">
                                            <button class="btn btn-primary" type="button">Salva</button>
                                        </div>
                                    </div>
                                </form>
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
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            (Chart.defaults.global.defaultFontFamily = "Metropolis"),
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = "#858796";

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    <?php $stmtGenere = $genere->getGenres(); ?>
                    labels: [<?php foreach($stmtGenere as $rowGenere) {
                        echo "'" . $rowGenere["nome"] . "', ";
                    } ?>], // Nomi generi
                    datasets: [{
                        <?php $stmtGenere = $film->getNumberByGenre(); ?>
                        data: [
                            <?php foreach($stmtGenere as $rowGenere) {
                            echo intval($rowGenere["count"]) . ", ";
                            } ?>
                        ], //Numero per genere
                        backgroundColor: [
                            "rgba(0, 97, 242, 1)",
                            "rgba(0, 172, 105, 1)",
                            "rgba(88, 0, 232, 1)",
                            "rgba(245, 66, 66)",
                            "rgba(245, 156, 66)",
                            "rgba(242, 245, 66)",
                            "rgba(245, 66, 233)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(0, 97, 242, 1)",
                            "rgba(0, 172, 105, 1)",
                            "rgba(88, 0, 232, 1)",
                            "rgba(245, 66, 66)",
                            "rgba(245, 156, 66)",
                            "rgba(242, 245, 66)",
                            "rgba(245, 66, 233)"
                        ],
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: "#dddfeb",
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80
                }
            });
        </script>

        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/date-range-picker-demo.js"></script>
    </body>
</html>
