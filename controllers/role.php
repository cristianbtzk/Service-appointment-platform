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