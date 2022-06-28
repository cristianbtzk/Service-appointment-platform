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
  while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $name = $linha['name'];
    $pass_bd = $linha['password'];
  }
  if (sha1($pass) == $pass_bd) {
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    header("location:../categories.php");
  }
}
