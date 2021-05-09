<?php
class Abbonamento {

  // connection
  private $conn;

  // table
  private $db_table = "Abbonamenti";

  // Properties
  public $id;
  public $idCategoria;
  
  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function newAbbonamento() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (dataFine, idCategoria) VALUES ('" . date('Y-m-d', strtotime($Date. ' + 30 days') . "', :idCategoria);";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));

    $stmt->bindParam(':idCategoria', $this->idCategoria);

    $stmt->execute();
  }
}

?>