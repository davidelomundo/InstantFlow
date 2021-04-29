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
    $sqlQuery = "INSERT INTO " . $this->db_table . " (dataFine, idCategoria) VALUES ('" . "2021-05-29" . "', '" . $this->idCategoria . "');";
    
    $stmt = $this->conn->prepare($sqlQuery);

    // bind data
    $stmt->bindParam(':idCategoria', $this->idCategoria);

    $stmt->execute();
  }
}

?>