<?php

namespace App\Models;

/**
 * Class Database
 *
 * Manages the PDO database connection using environment variables.
 */
class Database
{

    /** @var string */
    private $host;

    /** @var string */
    private $database_name;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var PDO|null */
    public $conn;

    /**
     * Constructor
     *
     * Reads database credentials from environment variables.
     */
    public function __construct()
    {
        $this->host          = getenv("DB_HOST");
        $this->database_name = getenv("DB_NAME");
        $this->username      = getenv("DB_USERNAME");
        $this->password      = getenv("DB_PASSWORD");
    }

    /**
     * Get database connection
     *
     * @return PDO|null
     */
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new \PDO(
                "mysql:host={$this->host};dbname={$this->database_name}",
                $this->username,
                $this->password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );

            $this->conn->exec("SET NAMES utf8");
        } catch (\PDOException $exception) {
            // Do not expose credentials or internal details
            error_log("Database connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
