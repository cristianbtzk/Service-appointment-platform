<?php

include_once __DIR__ . "/../conf/default.inc.php";
require_once __DIR__ . "/../conf/Connection.php";
require_once __DIR__ ."/../autoload.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  deleteCategory($id);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if ($action == "create") {
  $title = isset($_POST['title']) ? $_POST['title'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  createCategory($title, $description);
}

function findAllCategories()
{
  $pdo = Connection::getInstance();
  $query = $pdo->query("SELECT * from categories");
  $result = array();
  foreach($query as $row){
    array_push($result, new Category($row['title'], $row['description'], $row['id']));
  }
  return $result;
}

function createCategory($title, $description)
{
  $pdo = Connection::getInstance();
  $consulta = $pdo->query("INSERT INTO categories (title, description) values ('$title', '$description')");

  header("location:../categories.php");
}

function deleteCategory($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM categories WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../categories.php");
}