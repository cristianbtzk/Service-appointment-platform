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
  $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : "";
  $title = isset($_POST['title']) ? $_POST['title'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  $password = isset($_POST['password']) ? $_POST['password'] : "";
  $minDate = isset($_POST['min-date']) ? $_POST['min-date'] : "";
  $maxDate = isset($_POST['max-date']) ? $_POST['max-date'] : "";
  print_r($minDate);
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
  print_r($query);
  $query->execute();

  header("location:../categories.php");
}
