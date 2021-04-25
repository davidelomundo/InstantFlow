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

  public function createUser() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome, cognome, email, password, isAdmin) VALUES ('" . $this->nome . "','" . $this->cognome . "','" . $this->email . "','" . $this->password . "', 0);";
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

  public function login() {

    $sqlQuery = "SELECT * FROM Utenti WHERE email='" . $this->email . "' AND password='" . $this->password . "';";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();


    foreach ($stmt as $row) {
      if(!empty($row["id"]))
        return $row["id"];
      else
        return null;
    }
  }



}
?>