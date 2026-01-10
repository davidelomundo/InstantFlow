<?php

namespace App\Models;

/**
 * Class Category
 *
 * Handles category-related database operations.
 */
class Category
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "categories";

  // Public properties mapped to table columns
  public $id;
  public $name;
  public $price;
  public $resolution;

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
   * Create a new category
   *
   * @return void
   */
  public function createCategory()
  {
    $sql = "INSERT INTO {$this->db_table} (name, price) VALUES (:name, :price)";
    $stmt = $this->conn->prepare($sql);

    // Sanitize input
    $this->name = htmlspecialchars(strip_tags($this->name));

    // Bind parameters
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':price', $this->price);

    $stmt->execute();
  }

  /**
   * Get all categories
   *
   * @return PDOStatement
   */
  public function getCategories()
  {
    $sql = "SELECT * FROM {$this->db_table}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Find category by ID
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
