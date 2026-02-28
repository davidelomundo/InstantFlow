<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;
use App\Models\User;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if (isset($_SESSION["userId"])) {
    $user->id = $_SESSION["userId"];
    $user->delete();
    session_destroy();
}

// Redirect to the homepage or login page
header("Location: index.php");
exit;
