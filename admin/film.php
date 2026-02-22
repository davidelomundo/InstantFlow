<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;
use App\Models\User;
use App\Models\Film;
use App\Models\Genre;

if (empty($_SESSION["idAdmin"])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$film = new Film($db);
$genre = new Genre($db);

$user->id = $_SESSION["idAdmin"];
$rowUser = $user->getInfo();

$stmtFilm = $film->getFilms();

if (isset($_GET["idFilm"]) && !empty($_GET["idFilm"])) {
    $film->id = $_GET["idFilm"];
    $film->delete();
}

if (isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["description"]) && !empty($_POST["description"]) && isset($_POST["releaseDate"]) && !empty($_POST["releaseDate"])) {

    $film->title = $_POST["title"];
    $film->description = $_POST["description"];
    $film->releaseDate = $_POST["releaseDate"];
    $film->createFilm();

    $film->title = $_POST["title"];
    $rowFilm = $film->getInfo();

    mkdir("../resources/" . $rowFilm["id"]);
    move_uploaded_file($_FILES["preview"]["tmp_name"], "../resources/" . $rowFilm["id"] . "/preview.jpg");
    move_uploaded_file($_FILES["content"]["tmp_name"], "../resources/" . $rowFilm["id"] . "/film.mp4");
}

require_once "includes/head.php";
include "includes/navbar.php";
?>

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
                        <div class="page-header-subtitle">Here you will find the tools needed to manage films</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-n10">
        <div class="row mb-4">
            <div class="col-xl-6 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Monthly Earnings
                    </div>
                    <div class="card-body">
                        <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-4">
                <!-- Pie chart with legend example-->
                <div class="card h-100">
                    <div class="card-header">Genres</div>
                    <div class="card-body">
                        <div class="chart-pie mb-4"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Films</div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Release Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Release Date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($stmtFilm as $rowFilm) { ?>
                                <tr>
                                    <td><?php echo $rowFilm["title"]; ?></td>
                                    <td><?php echo $rowFilm["description"]; ?></td>
                                    <td><?php echo date("d/m/Y", strtotime(date($rowFilm["release_date"]))); ?></td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="<?= "?idFilm=" . $rowFilm["id"] ?>"><i data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">New Film</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <!-- Form Row-->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputTitle">Name</label>
                            <input class="form-control" id="inputTitle" type="text" value="" name="title" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputDescription">Description</label>
                            <input class="form-control" id="inputDescription" type="text" value="" name="description" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="inputReleaseDate">Release Date</label>
                        <input class="form-control" id="inputReleaseDate" type="date" value="" name="releaseDate" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputPreview">Preview</label>
                            <input class="form-control" id="inputPreview" type="file" accept=".jpg" value="" name="preview" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small mb-1" for="inputContent">Content</label>
                            <input class="form-control" id="inputContent" type="file" accept=".mp4" name="content" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>
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
            <?php $stmtGenre = $genre->getGenres(); ?>
            labels: [<?php foreach ($stmtGenre as $rowGenre) {
                            echo "'" . $rowGenre["name"] . "', ";
                        } ?>],
            datasets: [{
                data: [
                    <?php
                    $stmtGenre = $film->getNumberByGenre();

                    foreach ($stmtGenre as $rowGenre) {
                        echo intval($rowGenre["count"]) . ", ";
                    }
                    ?>
                ],
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