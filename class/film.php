<?php
class Film {

  // connection
  private $conn;

  // table
  private $db_table = "Films";

  // Properties
  public $id;
  public $titolo;
  public $dataUscita;
  public $descrizione;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  public function createFilm() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (titolo, dataUscita, descrizione) VALUES ('" . $this->titolo . "', '" . $this->dataUscita . "', '" . $this->descrizione . "');";
    var_dump($sqlQuery);
    $stmt = $this->conn->prepare($sqlQuery);

    // bind data
    $stmt->bindParam(':titolo', $this->titolo);
    $stmt->bindParam(':dataUscita', $this->dataUscita);
    $stmt->bindParam(':descrizione', $this->descrizione);

    $stmt->execute();
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