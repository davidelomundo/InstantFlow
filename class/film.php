<?php
class Film {

  // connection
  private $conn;

  // table
  private $db_table = "Films";

  // Properties
  public $id;
  public $titolo;
  public $descrizione;
  public $dataUscita;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  public function createFilm() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (titolo, dataUscita, descrizione) VALUES ('" . $this->titolo . "', '" . $this->dataUscita . "', '" . $this->descrizione . "');";
    $stmt = $this->conn->prepare($sqlQuery);

    // bind data
    $stmt->bindParam(':titolo', $this->titolo);
    $stmt->bindParam(':dataUscita', $this->dataUscita);
    $stmt->bindParam(':descrizione', $this->descrizione);

    $stmt->execute();
  }

  // Methods
  public function delete() {
    $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id='" . $this->id . "';";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
  }

  public function getFilms() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
    return $stmt;
  }

  public function findFilms() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE titolo LIKE :titolo;";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->titolo = htmlspecialchars(strip_tags($this->titolo));

    $this->titolo = "%" . $this->titolo . "%";
    $stmt->bindParam(':titolo', $this->titolo);

    $stmt->execute();
    return $stmt;
  }

  public function getFilmsByGenre($idGenere) {
    $sqlQuery = "SELECT " . $this->db_table . "* FROM " . $this->db_table . " JOIN Appartiene ON Films.id=Appartiene.idFilm WHERE Appartiene.idGenere='" . $idGenere . "';";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
    return $stmt;
  }

  public function getInfo() {
    $sqlQuery = "SELECT " . $this->db_table . ".* FROM " . $this->db_table . " WHERE titolo=:titolo;";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->titolo = htmlspecialchars(strip_tags($this->titolo));

    $stmt->bindParam(':titolo', $this->titolo);

    $stmt->execute();

    foreach($stmt as $row) {
      return $row;
    }
  }
}

?>