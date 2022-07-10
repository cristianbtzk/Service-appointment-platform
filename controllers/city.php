<?php

include_once __DIR__ . "/../conf/default.inc.php";
require_once __DIR__ . "/../conf/Connection.php";
require_once __DIR__ . "/../autoload.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";
if ($action == "getCitiesByStateId") {
  $stateId = $_POST['stateId'];
  citiesOptions($stateId);
}

function citiesOptions($stateId) {
  $cities = findCitiesByStateId($stateId);
  foreach ($cities as $city) {
    $id = $city->getId();
    echo "<option value='$id' >". $city->getName(). "</option>";
  }
}

function findCitiesByStateId($stateId)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare("SELECT * from cities where state_id=:state_id");
  $query->bindValue(':state_id', $stateId, PDO::PARAM_STR);
  $query->execute();
  $result = array();
  foreach ($query as $row) {
    array_push($result, new City($row['state_id'], $row['name'], $row['id']));
  }
  return $result;
}
