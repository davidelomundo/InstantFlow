<?php

class Abbonamento {

  // connection
  private $conn;

  // table
  private $db_table = "abbonamenti";

  // Properties
  public $id;
  public $dataFine;
  public $idUtente;
  public $idCategoria;
  
  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function newAbbonamento() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (dataFine, idUtente, idCategoria) VALUES ('" . date('Y-m-d', strtotime(date('Y-m-d') . ' + 30 days')) . "',:idUtente,  :idCategoria);";
    $stmt = $this->conn->prepare($sqlQuery);
    
    $stmt->bindParam(':idUtente', $this->idUtente);
    $stmt->bindParam(':idCategoria', $this->idCategoria);

    $stmt->execute();
  }

  public function isSubscribed() {
    $sqlQuery = "SELECT COUNT(*) as count FROM " . $this->db_table . " WHERE idUtente=:idUtente AND dataFine>CURDATE();";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->bindParam(':idUtente', $this->idUtente);

    $stmt->execute();

    foreach($stmt as $row) {
      if($row["count"] > 0) {
        return true;
      }
    }
  }
}
?>