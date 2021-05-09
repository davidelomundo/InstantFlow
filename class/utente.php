<?php
class Utente {

  // connection
  private $conn;

  // table
  private $db_table = "Utenti";

  // Properties
  public $id;
  public $nome;
  public $cognome;
  public $email;
  public $password;
  public $isAdmin;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function getUsers() {
    $sqlQuery = "SELECT * FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
  }

  public function updateUser() {
    $sqlQuery = "UPDATE " . $this->db_table . " SET nome=:nome, cognome=:cognome, email=:email, password=:password WHERE id=:id;";
    $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cognome = htmlspecialchars(strip_tags($this->cognome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->psw = htmlspecialchars(strip_tags($this->password));
    
        // bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cognome', $this->cognome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

    $stmt->execute();

    return true;
  }

  public function createUser() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome, cognome, email, password, isAdmin) VALUES (:nome, :cognome, :email, :password, 0);";
    $stmt = $this->conn->prepare($sqlQuery);

    // sanitize
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->cognome = htmlspecialchars(strip_tags($this->cognome));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->psw = htmlspecialchars(strip_tags($this->password));

    // bind data
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':cognome', $this->cognome);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);

    $stmt->execute();

    return true;
  }

  public function createAdmin() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome, cognome, email, password, isAdmin) VALUES (:nome, :cognome, :email, :password, 1);";
    $stmt = $this->conn->prepare($sqlQuery);

    // sanitize
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->cognome = htmlspecialchars(strip_tags($this->cognome));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->psw = htmlspecialchars(strip_tags($this->password));

    // bind data
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':cognome', $this->cognome);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);

    $stmt->execute();

    return true;
  }

  public function loginUser() {

    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE email=:email AND password=:password;";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->psw = htmlspecialchars(strip_tags($this->password));

    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);

    $stmt->execute();

    foreach ($stmt as $row) {
      if(!empty($row["id"]))
        return $row["id"];
      else
        return null;
    }
  }

  public function loginAdmin() {

    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE email=:email AND password=:password AND isAdmin=1;";
    $stmt = $this->conn->prepare($sqlQuery);

    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->psw = htmlspecialchars(strip_tags($this->password));

    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);

    $stmt->execute();

    foreach ($stmt as $row) {
      if(!empty($row["id"]))
        return $row["id"];
      else
        return null;
    }
  }

  public function getInfo() {

    $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE id=" . $this->id . ";";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }
  }

  public function count() {

    $sqlQuery = "SELECT COUNT(*) as count FROM " . $this->db_table . ";";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();

    foreach ($stmt as $row) {
      return $row;
    }
  }

}
?>