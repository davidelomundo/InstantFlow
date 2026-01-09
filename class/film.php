<?php

/**
 * Class Film
 *
 * Handles film-related database operations.
 */
class Movie
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "films";

  // Public properties mapped to table columns
  public $id;
  public $title;
  public $description;
  public $releaseDate;

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
   * Create a new film
   *
   * @return void
   */
  public function createFilm()
  {
    $sql = "
            INSERT INTO {$this->db_table} (titolo, dataUscita, descrizione)
            VALUES ('{$this->title}', '{$this->releaseDate}', '{$this->description}')
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
  }

  /**
   * Delete a film by ID
   *
   * @return void
   */
  public function delete()
  {
    $sql = "DELETE FROM {$this->db_table} WHERE id = '{$this->id}'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
  }

  /**
   * Get all films
   *
   * @return PDOStatement
   */
  public function getFilms()
  {
    $sql = "SELECT * FROM {$this->db_table}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Find films by title (LIKE)
   *
   * @return PDOStatement
   */
  public function findFilms()
  {
    $sql = "SELECT * FROM {$this->db_table} WHERE titolo LIKE :titolo";
    $stmt = $this->conn->prepare($sql);

    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->title = "%{$this->title}%";

    $stmt->bindParam(':titolo', $this->title);
    $stmt->execute();

    return $stmt;
  }

  /**
   * Get films by genre
   *
   * @param int|string $idGenere
   * @return PDOStatement
   */
  public function getFilmsByGenre($idGenere)
  {
    $sql = "
            SELECT {$this->db_table}.*
            FROM {$this->db_table}
            JOIN appartiene
              ON {$this->db_table}.id = appartiene.idFilm
            WHERE appartiene.idGenere = '{$idGenere}'
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Get number of films grouped by genre
   *
   * @return PDOStatement
   */
  public function getNumberByGenre()
  {
    $sql = "SELECT COUNT(*) AS count FROM appartiene GROUP BY idGenere";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Get film info by title
   *
   * @return array|null
   */
  public function getInfo()
  {
    $sql = "SELECT * FROM {$this->db_table} WHERE titolo = :titolo";
    $stmt = $this->conn->prepare($sql);

    $this->title = htmlspecialchars(strip_tags($this->title));
    $stmt->bindParam(':titolo', $this->title);

    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }

    return null;
  }

  /**
   * Count total films
   *
   * @return array
   */
  public function count()
  {
    $sql = "SELECT COUNT(*) AS count FROM {$this->db_table}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }
    return [];
  }

  /**
   * Get film by ID
   *
   * @return array|null
   */
  public function getById()
  {
    $sql = "SELECT * FROM {$this->db_table} WHERE id = {$this->id}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }

    return null;
  }
}
