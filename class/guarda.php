<?php

/**
 * Class WatchLog
 *
 * Handles logging of user watch activity.
 */
class WatchLog
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "guarda";

  // Public properties mapped to table columns
  public $id;
  public $duration;
  public $userId;
  public $movieId;

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
            INSERT INTO {$this->db_table} (idUtente, idFilm, data)
            VALUES (:idUtente, :idFilm, NOW())
        ";

    $stmt = $this->conn->prepare($sql);

    // Sanitize inputs
    $this->userId = htmlspecialchars(strip_tags($this->userId));
    $this->movieId   = htmlspecialchars(strip_tags($this->movieId));

    // Bind parameters
    $stmt->bindParam(':idUtente', $this->userId);
    $stmt->bindParam(':idFilm', $this->movieId);

    $stmt->execute();
  }
}
