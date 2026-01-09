<?php

/**
 * Class Subscription
 *
 * Handles subscription-related database operations.
 */
class Subscription
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "abbonamenti";

  // Public properties mapped to table columns
  public $id;
  public $dataFine;
  public $idUtente;
  public $idCategoria;

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
   * Create a new subscription with expiration 30 days from now
   *
   * @return void
   */
  public function createSubscription()
  {
    $dataFine = date('Y-m-d', strtotime('+30 days'));

    $sql = "
            INSERT INTO {$this->db_table} (dataFine, idUtente, idCategoria)
            VALUES ('{$dataFine}', :idUtente, :idCategoria)
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idUtente', $this->idUtente);
    $stmt->bindParam(':idCategoria', $this->idCategoria);
    $stmt->execute();
  }

  /**
   * Check if a user has an active subscription
   *
   * @return bool
   */
  public function isSubscribed()
  {
    $sql = "
            SELECT COUNT(*) AS count
            FROM {$this->db_table}
            WHERE idUtente = :idUtente AND dataFine > CURDATE()
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idUtente', $this->idUtente);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row['count'] > 0;
    }

    return false;
  }

  /**
   * Get the latest subscription expiration date for a user
   *
   * @return array|null
   */
  public function getExpiration()
  {
    $sql = "
            SELECT MAX(dataFine) AS scadenza
            FROM {$this->db_table}
            WHERE idUtente = :idUtente
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idUtente', $this->idUtente);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }

    return null;
  }
}
