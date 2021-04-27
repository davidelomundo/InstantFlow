<?php
class Film {

  // connection
  private $conn;

  // table
  private $db_table = "Films";

  // Properties
  public $id;
  public $nome;
  public $cognome;
  public $numero;
  public $scadenza;
  public $cvv;
  public $idUtente;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function getFilms() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
    return $stmt;
  }
}

?>