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
  $name = isset($_POST['name']) ? $_POST['name'] : "";
  $abbreviation = isset($_POST['abbreviation']) ? $_POST['abbreviation'] : "";
  createState($name, $abbreviation);
}

function createState($name, $abbreviation)
{
  $pdo = Connection::getInstance();
  $consulta = $pdo->query("INSERT INTO states (name, abbreviation) values ('$name', '$abbreviation')");

  header("location:../categories.php");
}

function delete($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM states WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../categories.php");
}