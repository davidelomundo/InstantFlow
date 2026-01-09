<?php

/**
 * Class User
 *
 * Handles CRUD operations and authentication for users.
 */
class User
{

  /** @var PDO Database connection */
  private $conn;

  /** @var string Database table name */
  private $db_table = "utenti";

  // Public properties mapped to table columns
  public $id;
  public $firstName;
  public $lastName;
  public $email;
  public $password;
  public $isAdmin;

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
   * Sanitize input string
   *
   * @param mixed $value
   * @return mixed
   */
  private function sanitize($value)
  {
    return htmlspecialchars(strip_tags($value));
  }

  /**
   * Get AES password from environment
   *
   * @return string
   */
  private function getAesPassword()
  {
    return getenv("AES_PASSWORD");
  }

  /**
   * Get all users
   *
   * @return PDOStatement
   */
  public function getUsers()
  {
    $sql = "SELECT * FROM {$this->db_table}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  /**
   * Update user data
   *
   * @return bool
   */
  public function updateUser()
  {
    $sql = "
            UPDATE {$this->db_table}
            SET nome = :nome,
                cognome = :cognome,
                email = AES_ENCRYPT(:email, '{$this->getAesPassword()}')
            WHERE id = :id
        ";

    $stmt = $this->conn->prepare($sql);

    // Sanitize
    $this->id        = $this->sanitize($this->id);
    $this->firstName = $this->sanitize($this->firstName);
    $this->lastName  = $this->sanitize($this->lastName);
    $this->email     = $this->sanitize($this->email);

    // Bind
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':nome', $this->firstName);
    $stmt->bindParam(':cognome', $this->lastName);
    $stmt->bindParam(':email', $this->email);

    $stmt->execute();
    return true;
  }

  /**
   * Create a standard user
   *
   * @return bool
   */
  public function createUser()
  {
    return $this->create(false);
  }

  /**
   * Create an admin user
   *
   * @return bool
   */
  public function createAdmin()
  {
    return $this->create(true);
  }

  /**
   * Internal user creation method
   *
   * @param bool $isAdmin
   * @return bool
   */
  private function create($isAdmin)
  {
    $sql = "
            INSERT INTO {$this->db_table}
            (nome, cognome, email, password, is_admin)
            VALUES
            (:nome, :cognome, AES_ENCRYPT(:email, '{$this->getAesPassword()}'), :password, :is_admin)
        ";

    $stmt = $this->conn->prepare($sql);

    // Sanitize
    $this->firstName = $this->sanitize($this->firstName);
    $this->lastName  = $this->sanitize($this->lastName);
    $this->email     = $this->sanitize($this->email);

    // Bind
    $stmt->bindParam(':nome', $this->firstName);
    $stmt->bindParam(':cognome', $this->lastName);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindValue(':is_admin', $isAdmin ? 1 : 0, PDO::PARAM_INT);

    $stmt->execute();
    return true;
  }

  /**
   * User login
   *
   * @return int|null User ID or null
   */
  public function loginUser()
  {
    $sql = "
            SELECT *
            FROM {$this->db_table}
            WHERE email = AES_ENCRYPT(:email, '{$this->getAesPassword()}')
        ";

    $stmt = $this->conn->prepare($sql);

    $this->email = $this->sanitize($this->email);
    $stmt->bindParam(':email', $this->email);

    $stmt->execute();

    foreach ($stmt as $row) {
      if (password_verify($this->password, $row["password"])) {
        return $row["id"];
      }
    }

    return null;
  }

  /**
   * Admin login
   *
   * @return int|null Admin ID or null
   */
  public function loginAdmin()
  {
    $sql = "
            SELECT *
            FROM {$this->db_table}
            WHERE email = AES_ENCRYPT(:email, '{$this->getAesPassword()}')
              AND is_admin = 1
        ";

    $stmt = $this->conn->prepare($sql);

    $this->email = $this->sanitize($this->email);
    $stmt->bindParam(':email', $this->email);

    $stmt->execute();

    foreach ($stmt as $row) {
      if (password_verify($this->password, $row["password"])) {
        return $row["id"];
      }
    }

    return null;
  }


  /**
   * Get user info by ID
   *
   * @return array|null
   */
  public function getInfo()
  {
    $sql = "
            SELECT nome,
                   cognome,
                   AES_DECRYPT(email, '{$this->getAesPassword()}') AS email
            FROM {$this->db_table}
            WHERE id = {$this->id}
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }

    return null;
  }

  /**
   * Count total users
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
   * Delete user by ID
   */
  public function delete()
  {
    $sql = "DELETE FROM {$this->db_table} WHERE id = {$this->id}";
    $this->conn->query($sql);
  }

  /**
   * Get user's watch history
   *
   * @return PDOStatement
   */
  public function history()
  {
    $sql = "
            SELECT *
            FROM guarda
            WHERE idUtente = :id
              AND (data, idFilm) IN (
                  SELECT MAX(data), idFilm
                  FROM guarda
                  GROUP BY idFilm
              )
            GROUP BY idFilm
            ORDER BY data DESC
        ";

    $stmt = $this->conn->prepare($sql);

    $this->id = $this->sanitize($this->id);
    $stmt->bindParam(':id', $this->id);

    $stmt->execute();
    return $stmt;
  }
}
