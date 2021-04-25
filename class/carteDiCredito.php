<?php
class CartaDiCredito {

  // connection
  private $conn;

  // table
  private $db_table = "CarteDiCredito";

  // Properties
  public $id;
  public $nome;
  public $cognome;
  public $numero;
  public $scadenza;
  public $cvv;
  public $idUtente;

  // db connection
  public function __construct($db) {
    $this->conn = $db;
  }

  // Methods
  public function newPayment() {
    $sqlQuery = "INSERT INTO " . $this->db_table . " (nome, cognome, numero, scadenza, cvv, idUtente) VALUES ('" . $this->nome . "','" . $this->cognome . "','" . $this->numero . "','" . $this->scadenza . "','" . $this->cvv . "','" . 1 . "');";
    var_dump($sqlQuery);
    $stmt = $this->conn->prepare($sqlQuery);

    // bind data
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':cognome', $this->cognome);
    $stmt->bindParam(':numero', $this->numero);
    $stmt->bindParam(':scadenza', $this->scadenza);
    $stmt->bindParam(':cvv', $this->cvv);
    $stmt->bindParam(':idUtente', $this->idUtente);

    $stmt->execute();
  }
}

?>