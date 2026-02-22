<?php

namespace App\Models;

/**
 * Class Actor
 *
 * Handles actor-related database operations.
 */
class Actor
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "actors";

  // Public properties mapped to table columns
  public $id;
  public $firstName;
  public $lastName;

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
   * Create a new actor
   *
   * @return void
   */
  public function createActor()
  {
    $sql = "INSERT INTO {$this->db_table} (first_name, last_name) VALUES (:firstName, :lastName)";
    $stmt = $this->conn->prepare($sql);

    // Sanitize inputs
    $this->firstName = htmlspecialchars(strip_tags($this->firstName));
    $this->lastName = htmlspecialchars(strip_tags($this->lastName));

    // Bind parameters
    $stmt->bindParam(':firstName', $this->firstName);
    $stmt->bindParam(':lastName', $this->lastName);

    $stmt->execute();
  }

  /**
   * Get all actors
   *
   * @return PDOStatement
   */
  public function getActors()
  {
    $sql = "SELECT * FROM {$this->db_table}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Find actor by ID
   *
   * @return array|null
   */
  public function findById()
  {
    $sql = "SELECT * FROM {$this->db_table} WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $this->id);
    $stmt->execute();

    return $stmt->fetch() ?: null;
  }
}
