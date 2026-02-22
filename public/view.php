<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;
use App\Models\Film;
use App\Models\User;
use App\Models\Watch;
use App\Models\VideoStream;

if (!isset($_SESSION["userId"]) || empty($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$movie = new Film($db);
$watchLog = new Watch($db);
$stream = new VideoStream("../resources/" . $_GET["id"] . "/film.mp4");

$watchLog->userId = $_SESSION["userId"];
$watchLog->filmId = $_GET["id"];
$watchLog->duration = '00:00:00';
$watchLog->createLog();

$stream->start();
