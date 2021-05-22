<?php
class Genere {

  // connection
  private $conn;

  // table
  private $db_table = "generi";

  // Properties
  public $id;
  public $nome;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function getGenres() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);

    $stmt->execute();
    return $stmt;
  }

  public function newGenre() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome) VALUES (:nome);";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->nome = htmlspecialchars(strip_tags($this->nome));
    
    $stmt->bindParam(':nome', $this->nome);

    $stmt->execute();
  }

  public function getGenresByFilm($idFilm) {
    $sqlQuery = "SELECT " . $this->db_table . ".* FROM " . $this->db_table . " JOIN Appartiene ON " . $this->db_table . ".id=appartiene.idGenere WHERE appartiene.idFilm='" . $idFilm . "';";
    $stmt = $this->conn->prepare($sqlQuery);
    
    $stmt->execute();
    return $stmt;
  }
}

?>