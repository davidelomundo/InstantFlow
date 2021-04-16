<?php

try {
    $hostname = "localhost";
    $dbname = "InstantFlow";
    $user = "davidelomundo02";
    $pass = "instantPass";
    $connessione = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
}

/*
    $dbHost="localhost";
    $dbUserName="root";
    $dbPasswordName="";
    $dbName="instantflow";
    
    $connessione=mysqli_connect($dbHost, $dbUserName, $dbPasswordName, $dbName);
    $database=mysqli_select_db($connessione, $dbName);
    
    // Check connection
    if (!$connessione) {
        die("Connection failed: " . mysqli_connect_error());
    }
    */
?>