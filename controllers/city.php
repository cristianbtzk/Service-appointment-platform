<?php

include_once "../conf/default.inc.php";
require_once "../conf/Connection.php";
require_once "../autoload.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}



function delete($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM states WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../categories.php");
}