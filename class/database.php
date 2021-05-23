<?php
class Database {
    private $host = "localhost";
    private $database_name = "InstantFlow";
    private $username;
    private $password;

    public function __construct() {
        $this->username = getenv("DB_USERNAME");
        $this->password = getenv("DB_PASSWORD");
    }

    public $conn;
    
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
  }
?>