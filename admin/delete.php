<?php
session_start();

require_once "../class/database.php";
require_once "../class/utente.php";

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

$utente->id = $_SESSION["idAdmin"];
$utente->delete();
session_destroy();

header("Location: index.php");
?>