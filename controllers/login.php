<?php

include_once "../conf/default.inc.php";
require_once "../conf/Connection.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "logoff") {
  session_start();
  session_destroy();
  header("location:login.php");
}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if ($action == "login") {
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  $pass = isset($_POST['password']) ? $_POST['password'] : "";
  login($email, $pass);
}

function login($email, $pass)
{
  $pdo = Connection::getInstance();
  $consulta = $pdo->query("SELECT * FROM users WHERE email = '$email'");
  $name = '';
  $pass_bd = '';
  $id = '';
  $roleId = '';
  while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $id = $linha['id'];
    $name = $linha['name'];
    $pass_bd = $linha['password'];
    $roleId = $linha['role_id'];
  }
  if (sha1($pass) == $pass_bd) {
    session_start();
    $_SESSION['userId'] = $id;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['roleId'] = $roleId;

    $dest = '';

    switch ($roleId) {
      case 1:
        $dest = 'categories.php';
        break;

      case 2:
        $dest = 'my-services.php';
        break;

      case 3:
        $dest = 'index.php';
        break;

      default:
        $dest = 'login.php';
        break;
    }

    header("location:../" . $dest);
  }
}
