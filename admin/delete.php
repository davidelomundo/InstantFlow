<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;
use App\Models\User;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if (isset($_SESSION["idAdmin"])) {
    $user->id = $_SESSION["idAdmin"];
    $user->delete();
    session_destroy();
}

header("Location: login.php");
exit;
