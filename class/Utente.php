<?php
class Utente {
  // Properties
  public $id;
  public $nome;
  public $cognome;
  public $email;
  public $password;

  // Methods
  function set_name($nome) {
    $this->nome = $nome;
  }
  function get_name() {
    return $this->nome;
  }
  
}
?>