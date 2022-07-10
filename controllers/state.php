<?php

include_once __DIR__ ."/../conf/default.inc.php";
require_once __DIR__ ."/../conf/Connection.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}

function findAllStates()
{
  $pdo = Connection::getInstance();
  $query = $pdo->query("SELECT * from states");
  $result = array();
  foreach($query as $row){
    array_push($result, new State($row['name'], $row['abbreviation'], $row['id']));
  }
  return $result;
}

function createState($name, $abbreviation)
{
  $pdo = Connection::getInstance();
  $consulta = $pdo->query("INSERT INTO states (name, abbreviation) values ('$name', '$abbreviation')");

  header("location:../categories.php");
}
