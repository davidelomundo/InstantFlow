<?php
class Film {

  // connection
  private $conn;

  // table
  private $db_table = "guarda";

  // Properties
  public $id;
  public $idUtente;
  public $idFilm;
  public $durata;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  public function createFilm() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (idUtente, idFilm, durata) VALUES ('" . $this->idUtente . "', '" . $this->idFilm . "', '" . $this->durata . "');";
    $stmt = $this->conn->prepare($sqlQuery);

    // bind data
    $stmt->bindParam(':titolo', $this->titolo);
    $stmt->bindParam(':dataUscita', $this->dataUscita);
    $stmt->bindParam(':descrizione', $this->descrizione);

    $stmt->execute();
  }
}

?>