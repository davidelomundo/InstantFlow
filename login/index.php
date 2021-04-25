<?php
session_start();

require_once '../includes/header.php';
require_once '../includes/database.php';
require_once "..//class/utente.php";

$database = new Database();
$db = $database->getConnection();
$utente = new Utente($db);

if(isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
  header("Location: logged.php");
}

if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]))
{
    $utente->email = $_POST["email"];
    $utente->password = $_POST["password"];
    
    $_SESSION["idUtente"] = $utente->loginUser();

    if(!empty($_SESSION["idUtente"])) {
      header("Location: ./logged.php");
    }

} else {
?>

<style>
html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>

<body class="text-center">
    
    <main class="form-signin">
      <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Accesso</h1>
    
        <div class="form-floating">
          <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
    
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>
    </main>
</body>

<?php
}
?>