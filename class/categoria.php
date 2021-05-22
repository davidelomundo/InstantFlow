<?php
class Categoria {

  // connection
  private $conn;

  // table
  private $db_table = "categorie";

  // Properties
  public $id;
  public $nome;
  public $prezzo;
  public $risoluzione;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function newCategory() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome) VALUES (:nome);";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->nome = htmlspecialchars(strip_tags($this->nome));

    $stmt->bindParam(':nome', $this->nome);

    $stmt->execute();
  }

  public function getCategory() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);
    
    $stmt->execute();
    return $stmt;
  }

  public function findById() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE id='" . $this->id . "';";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
    foreach ($stmt as $row) {
      return $row;
    }
  }

}

?>