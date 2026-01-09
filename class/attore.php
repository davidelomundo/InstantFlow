<?php

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
  private $db_table = "attori";

  // Public properties mapped to table columns
  public $id;
  public $nome;
  public $cognome;

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
  public function newActor()
  {
    $sql = "INSERT INTO {$this->db_table} (nome, cognome) VALUES (:nome, :cognome)";
    $stmt = $this->conn->prepare($sql);

    // Sanitize inputs
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->cognome = htmlspecialchars(strip_tags($this->cognome));

    // Bind parameters
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':cognome', $this->cognome);

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
    $sql = "SELECT * FROM {$this->db_table} WHERE id = '{$this->id}'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }

    return null;
  }
}
