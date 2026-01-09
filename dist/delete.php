<?php
session_start();

require_once "../class/database.php";
require_once "../class/utente.php";

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if(isset($_SESSION["idUtente"])) {
    $user->id = $_SESSION["idUtente"];
    $user->delete();
    session_destroy();
}

// Redirect to the homepage or login page
header("Location: index.php");
exit;
?>