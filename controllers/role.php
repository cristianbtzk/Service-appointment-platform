<?php

include_once __DIR__ . "/../conf/default.inc.php";
require_once __DIR__ . "/../conf/Connection.php";
require_once __DIR__ ."/../autoload.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if ($action == "create") {
  $title = isset($_POST['title']) ? $_POST['title'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  createRole($title, $description);
}

function createRole($description)
{
  $pdo = Connection::getInstance();
  $consulta = $pdo->query("INSERT INTO roles (description) values ('$description')");

  header("location:../categories.php");
}

function delete($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM roles WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../categories.php");
}

function findNonAdmin()
{
  $pdo = Connection::getInstance();
  $query = $pdo->query("SELECT * from roles WHERE roles.description != 'Admin'");
  $result = array();
  foreach($query as $row){
    array_push($result, new Role($row['description'], $row['id']));
  }
  return $result;
}