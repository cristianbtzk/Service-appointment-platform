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
  $serviceId = isset($_POST['service_id']) ? $_POST['service_id'] : "";
  $to = isset($_POST['to']) ? $_POST['to'] : "";
  $date = new DateTime();
  $text = isset($_POST['text']) ? $_POST['text'] : "";
  $message = new Message($serviceId, $to, $userId, $date, $text);
  createMessage($message);
}

if ($action == "update") {
  $userId = $_SESSION['userId'];

  $id = isset($_POST['id']) ? $_POST['id'] : "";
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

function findMessagesByUserIdsService($userId1, $userId2 ,$serviceId)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare("SELECT * from messages where service_id=:service_id AND from IN (:user1, :user2) AND to IN (:user1, :user2)");
  $query->bindValue(':service_id', $serviceId, PDO::PARAM_STR);
  $query->bindValue(':user1', $userId1, PDO::PARAM_STR);
  $query->bindValue(':user2', $userId2, PDO::PARAM_STR);
  $query->execute();
  $result = array();
  foreach($query as $row){
    array_push($result, new Message($row['service_id'], $row['to'], $row['from'], $row['date'], $row['text'], $row['id']));
  }
  return $result;
}

function createMessage(Message $message)
{
  $pdo = Connection::getInstance();

  $query = $pdo->prepare("INSERT INTO messages (from, to, service_id, date, text) 
    values (:from, :to, :service_id, :date, :text);");
  $query->bindValue(':from', $message->getFrom(), PDO::PARAM_STR);
  $query->bindValue(':to', $message->getTo(), PDO::PARAM_STR);
  $query->bindValue(':service_id', $message->getService(), PDO::PARAM_STR);
  $query->bindValue(':date',$message->getDate(), PDO::PARAM_STR);
  $query->bindValue(':text', $message->getText(), PDO::PARAM_STR);
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