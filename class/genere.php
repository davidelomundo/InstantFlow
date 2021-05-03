<?php
class Genere {

  // connection
  private $conn;

  // table
  private $db_table = "Generi";

  // Properties
  public $id;
  public $nome;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function getGenres() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
    return $stmt;
  }

  public function newGenre() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome) VALUES ('" . $this->nome . "');";
    $stmt = $this->conn->prepare($sqlQuery);

    // bind data
    $stmt->bindParam(':nome', $this->nome);

    $stmt->execute();
  }
}

?>