<?php

include_once __DIR__ ."/../conf/default.inc.php";
require_once __DIR__ ."/../conf/Connection.php";
require_once __DIR__ ."/../autoload.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if ($action == "create") {
  $roleId = isset($_POST['role']) ? $_POST['role'] : "";
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  $name = isset($_POST['name']) ? $_POST['name'] : "";
  $password = isset($_POST['password']) ? $_POST['password'] : "";
  $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
  $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : null;
  $user = new User($roleId, $name, $email, $password, $cpf, $cnpj);
  create($user);
}

function create(User $user)
{
  $pdo = Connection::getInstance();
  $passwordHash = sha1($user->getPassword());

  $query = $pdo->prepare("INSERT INTO users (is_active, role_id, email, name, password, cpf, cnpj) values (1, :role_id, :email, :name, :password, :cpf, :cnpj);");
  $query->bindValue(':role_id', $user->getRole(), PDO::PARAM_STR);
  $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
  $query->bindValue(':name', $user->getName(), PDO::PARAM_STR);
  $query->bindValue(':password',$passwordHash, PDO::PARAM_STR);
  $query->bindValue(':cpf', $user->getCpf(), PDO::PARAM_STR);
  $query->bindValue(':cnpj', $user->getCnpj(), PDO::PARAM_STR);

  $query->execute();

  header("location:../login.php");
}
