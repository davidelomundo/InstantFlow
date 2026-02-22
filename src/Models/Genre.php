<?php

namespace App\Models;

use PDO, PDOStatement;

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
  private $db_table = "genres";

  // Public properties mapped to table columns
  public $id;
  public $name;

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
  public function createGenre()
  {
    $sql = "INSERT INTO {$this->db_table} (name) VALUES (:name)";
    $stmt = $this->conn->prepare($sql);

    // Sanitize input
    $this->name = htmlspecialchars(strip_tags($this->name));

    // Bind parameter
    $stmt->bindParam(':name', $this->name);

    $stmt->execute();
  }

  /**
   * Get genres associated with a specific film
   *
   * @param int|string $filmId
   * @return PDOStatement
   */
  public function getGenresByFilm($filmId)
  {
    $sql = "
            SELECT {$this->db_table}.*
            FROM {$this->db_table}
            JOIN has_genre
              ON {$this->db_table}.id = has_genre.genre_id
            WHERE has_genre.film_id = :filmId
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':filmId', $filmId);
    $stmt->execute();
    return $stmt;
  }
}
