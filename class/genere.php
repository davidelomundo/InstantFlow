<?php

/**
 * Class Genre
 *
 * Handles genre-related database operations.
 */
class Genre
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "generi";

  // Public properties mapped to table columns
  public $id;
  public $nome;

  /**
   * Constructor
   *
   * @param PDO $db Database connection
   */
  public function __construct($db)
  {
    $this->conn = $db;
  }

  /**
   * Get all genres
   *
   * @return PDOStatement
   */
  public function getGenres()
  {
    $sql = "SELECT * FROM {$this->db_table} ORDER BY id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Create a new genre
   *
   * @return void
   */
  public function newGenre()
  {
    $sql = "INSERT INTO {$this->db_table} (nome) VALUES (:nome)";
    $stmt = $this->conn->prepare($sql);

    // Sanitize input
    $this->nome = htmlspecialchars(strip_tags($this->nome));

    // Bind parameter
    $stmt->bindParam(':nome', $this->nome);

    $stmt->execute();
  }

  /**
   * Get genres associated with a specific film
   *
   * @param int|string $idFilm
   * @return PDOStatement
   */
  public function getGenresByFilm($idFilm)
  {
    $sql = "
            SELECT {$this->db_table}.*
            FROM {$this->db_table}
            JOIN appartiene
              ON {$this->db_table}.id = appartiene.idGenere
            WHERE appartiene.idFilm = '{$idFilm}'
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }
}
