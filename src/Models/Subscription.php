<?php

namespace App\Models;

use PDO;

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
  private $db_table = "subscriptions";

  // Public properties mapped to table columns
  public $id;
  public $endDate;
  public $userId;
  public $categoryId;

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
    $endDate = date('Y-m-d', strtotime('+30 days'));

    $sql = "
            INSERT INTO {$this->db_table} (end_date, user_id, category_id)
            VALUES (:endDate, :userId, :categoryId)
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':userId', $this->userId);
    $stmt->bindParam(':categoryId', $this->categoryId);
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
            WHERE user_id = :userId AND end_date > CURDATE()
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':userId', $this->userId);
    $stmt->execute();

    $row = $stmt->fetch();
    return $row ? $row['count'] > 0 : false;
  }

  /**
   * Get the latest subscription expiration date for a user
   *
   * @return array|null
   */
  public function getExpiration()
  {
    $sql = "
            SELECT MAX(end_date) AS expiration
            FROM {$this->db_table}
            WHERE user_id = :userId
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':userId', $this->userId);
    $stmt->execute();

    return $stmt->fetch() ?: null;
  }
}
