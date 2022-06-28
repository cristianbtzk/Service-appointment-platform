<?php

include_once "../conf/default.inc.php";
require_once "../conf/Connection.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if ($action == "create") {
  $title = isset($_POST['title']) ? $_POST['title'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  createCategory($title, $description);
}

function createCategory($title, $description)
{
  $pdo = Connection::getInstance();
  $consulta = $pdo->query("INSERT INTO categories (title, description) values ('$title', '$description')");

  header("location:../categories.php");
}

function delete($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM categories WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../categories.php");
}