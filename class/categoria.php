<?php
class Categoria {

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
  public function newCategory() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome) VALUES (:nome);";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->nome = htmlspecialchars(strip_tags($this->nome));

    $stmt->bindParam(':nome', $this->nome);

    $stmt->execute();
  }
}

?>