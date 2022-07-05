<?php

include_once __DIR__ ."/../conf/default.inc.php";
require_once __DIR__ ."/../conf/Connection.php";
require_once __DIR__ ."/../autoload.php";

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == "delete") {
  $id = $_GET['id'];
  delete($id);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if ($action == "create") {
  $userId = $_SESSION['userId'];
  $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : "";
  $title = isset($_POST['title']) ? $_POST['title'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  $minDate = isset($_POST['min-date']) ? $_POST['min-date'] : "";
  $maxDate = isset($_POST['max-date']) ? $_POST['max-date'] : "";
  $service = new Service(1, $title, $categoryId, $userId, $maxDate, $minDate, $description);
  createService($service);
}

if ($action == "update") {
  $id = isset($_POST['id']) ? $_POST['id'] : "";
  $userId = $_SESSION['userId'];
  $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : "";
  $title = isset($_POST['title']) ? $_POST['title'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  $minDate = isset($_POST['min-date']) ? $_POST['min-date'] : "";
  $maxDate = isset($_POST['max-date']) ? $_POST['max-date'] : "";
  $service = new Service(1, $title, $categoryId, $userId, $maxDate, $minDate, $description, $id);
  updateService($service);
}

function findServiceById($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare("SELECT * from services where id=:id");
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();

  $row = $query->fetch(PDO::FETCH_ASSOC);

  if($row) {
    return new Service($row['status_id'], $row['title'], $row['category_id'], $row['user_id'], $row['max_date'], $row['min_date'], $row['description'], $row['id']);
  }
  
  return $row;
}

function findByUser($userId)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare("SELECT * from services where user_id=:user_id");
  $query->bindValue(':user_id', $userId, PDO::PARAM_STR);
  $query->execute();
  $result = array();
  foreach($query as $row){
    array_push($result, new Service($row['status_id'], $row['title'], $row['category_id'], $row['user_id'], $row['max_date'], $row['min_date'], $row['description'], $row['id']));
  }
  return $result;
}

function createService(Service $service)
{
  $pdo = Connection::getInstance();

  $query = $pdo->prepare("INSERT INTO services (user_id, category_id, status_id, title, description, min_date, max_date) 
    values (:user_id, :category_id, :status_id, :title, :description, :min_date, :max_date);");
  $query->bindValue(':user_id', $service->getUser(), PDO::PARAM_STR);
  $query->bindValue(':category_id', $service->getCategory(), PDO::PARAM_STR);
  $query->bindValue(':status_id', $service->getStatus(), PDO::PARAM_STR);
  $query->bindValue(':title',$service->getTitle(), PDO::PARAM_STR);
  $query->bindValue(':description', $service->getDescription(), PDO::PARAM_STR);
  $query->bindValue(':min_date', $service->getMinDate(), PDO::PARAM_STR);
  $query->bindValue(':max_date', $service->getMaxDate(), PDO::PARAM_STR);
  print_r($query);
  $query->execute();

  header("location:../my-services.php");
}

function updateService(Service $service)
{
  $pdo = Connection::getInstance();
  print_r($service);
  $query = $pdo->prepare('UPDATE services SET title=:title, description=:description, min_date=:min_date, max_date=:max_date WHERE id=:id;');
  $query->bindValue(':title', $service->getTitle(), PDO::PARAM_STR);
  $query->bindValue(':description', $service->getDescription(), PDO::PARAM_STR);
  $query->bindValue(':min_date', $service->getMinDate(), PDO::PARAM_STR);
  $query->bindValue(':max_date',$service->getMaxDate(), PDO::PARAM_STR);
  $query->bindValue(':id', $service->getId(), PDO::PARAM_STR);
  $query->execute();
  header("location:../my-services.php");
}

function deleteService($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM services WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../my-services.php");
}