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

  public function createUser($nome, $cognome, $email, $password) {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome, cognome, email, password, isAdmin) VALUES ('" . $nome . "','" . $cognome . "','" . $email . "','" . $password . "', 0);";
    $stmt = $this->conn->prepare($sqlQuery);

    /*// sanitize
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->cognome = htmlspecialchars(strip_tags($this->cognome));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->psw = htmlspecialchars(strip_tags($this->password));

    // bind data
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':cognome', $this->cognome);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);*/



    $stmt->execute();
  }

  public function login($email, $password) {

    $sqlQuery = "SELECT *, COUNT(*) AS numRows FROM Utenti WHERE email='" . $email . "' AND password='" . $password . "';";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();


    foreach ($stmt as $row) {
      if($row["numRows"]>0)
        return true;
      else
        return false;
    }
  }

}
?>