<?php
class Guarda {

  // connection
  private $conn;

  // table
  private $db_table = "guarda";

  // Properties
  public $id;
  public $durata;
  public $idUtente;
  public $idFilm;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  public function createLog() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (durata, idUtente, idFilm) VALUES (NOW(), :idUtente, :idFilm);";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->email = htmlspecialchars(strip_tags($this->durata));
    $this->email = htmlspecialchars(strip_tags($this->idFilm));
    $this->email = htmlspecialchars(strip_tags($this->idUtente));
    //$stmt->bindParam(':durata', $this->durata);
    $stmt->bindParam(':idUtente', $this->idUtente);
    $stmt->bindParam(':idFilm', $this->idFilm);

    $stmt->execute();
  }
}

?>