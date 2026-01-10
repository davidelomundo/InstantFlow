<?php

namespace App\Models;

/**
 * Class Watch
 *
 * Handles logging of user watch activity.
 */
class Watch
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "watches";

  // Public properties mapped to table columns
  public $id;
  public $duration;
  public $userId;
  public $filmId;

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
   * Create a watch log entry
   *
   * @return void
   */
  public function createLog()
  {
    $sql = "
            INSERT INTO {$this->db_table} (user_id, film_id, watched_at, duration)
            VALUES (:userId, :filmId, NOW(), :duration)
        ";

    $stmt = $this->conn->prepare($sql);

    // Sanitize inputs
    $this->userId = htmlspecialchars(strip_tags((string)$this->userId));
    $this->filmId = htmlspecialchars(strip_tags((string)$this->filmId));

    // Bind parameters
    $stmt->bindParam(':userId', $this->userId);
    $stmt->bindParam(':filmId', $this->filmId);
    $stmt->bindParam(':duration', $this->duration);

    $stmt->execute();
  }
}
