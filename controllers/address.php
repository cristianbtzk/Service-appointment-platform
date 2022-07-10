<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

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
  print_r($_SESSION);
  $userId = $_SESSION['userId'];
  $cityId = isset($_POST['city_id']) ? $_POST['city_id'] : "";
  $houseNumber = isset($_POST['house_number']) ? $_POST['house_number'] : "";
  $street = isset($_POST['street']) ? $_POST['street'] : "";
  $postalCode = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
  $district = isset($_POST['district']) ? $_POST['district'] : "";
  $address = new Address($houseNumber, $street, $postalCode, $district, $userId, $cityId);
  create($address);
}
if($action == "update") {
  $id =isset($_POST['id']) ? $_POST['id'] : "";
  $userId = $_SESSION['userId'];
  $cityId = isset($_POST['city_id']) ? $_POST['city_id'] : "";
  $houseNumber = isset($_POST['house_number']) ? $_POST['house_number'] : "";
  $street = isset($_POST['street']) ? $_POST['street'] : "";
  $postalCode = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
  $district = isset($_POST['district']) ? $_POST['district'] : "";
  $address = new Address($houseNumber, $street, $postalCode, $district, $userId, $cityId, $id);
  update($address);
}

function findAll()
{
  $pdo = Connection::getInstance();
  $query = $pdo->query("SELECT * from addresses");
  $result = array();
  foreach($query as $row){
    array_push($result, new Address($row['house_number'], $row['street'], $row['postal_code'], $row['district'], $row['user_id'], $row['city_id'], $row['id']));
  }
  return $result;
}

function findById($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare("SELECT * from addresses where id=:id LIMIT 1;");
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();

  $row = $query->fetch(PDO::FETCH_ASSOC);

  if($row) {
    return new Address($row['house_number'], $row['street'], $row['postal_code'], $row['district'], $row['user_id'], $row['city_id'], $row['id']);
  }
  
  return $row;
}

function findAddressesByUserId()
{
  $pdo = Connection::getInstance();
  $userId = $_SESSION['userId'];
  $query = $pdo->prepare("SELECT * from addresses where user_id=:user_id");
  $query->bindValue(':user_id', $userId, PDO::PARAM_STR);
  $query->execute();
  $result = array();
  foreach($query as $row){
    array_push($result, new Address($row['house_number'], $row['street'], $row['postal_code'], $row['district'], $row['user_id'], $row['city_id'], $row['id']));
  }
  return $result;
}

function create(Address $address)
{
  $pdo = Connection::getInstance();

  $query = $pdo->prepare("INSERT INTO addresses (house_number, street, postal_code, district, user_id, city_id) 
    values (:house_number, :street, :postal_code, :district, :user_id, :city_id);");
  $query->bindValue(':house_number', $address->getHouseNumber(), PDO::PARAM_STR);
  $query->bindValue(':street', $address->getStreet(), PDO::PARAM_STR);
  $query->bindValue(':postal_code', $address->getPostalCode(), PDO::PARAM_STR);
  $query->bindValue(':district',$address->getDistrict(), PDO::PARAM_STR);
  $query->bindValue(':user_id', $address->getUser(), PDO::PARAM_STR);
  $query->bindValue(':city_id', $address->getCity(), PDO::PARAM_STR);

  $query->execute();

  header("location:../my-addresses.php");
}

function update(Address $address)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('UPDATE addresses SET house_number=:house_number, street=:street, postal_code=:postal_code, district=:district, city_id=:city_id WHERE id=:id;');
  $query->bindValue(':house_number', $address->getHouseNumber(), PDO::PARAM_STR);
  $query->bindValue(':street', $address->getStreet(), PDO::PARAM_STR);
  $query->bindValue(':postal_code', $address->getPostalCode(), PDO::PARAM_STR);
  $query->bindValue(':district',$address->getDistrict(), PDO::PARAM_STR);
  $query->bindValue(':city_id', $address->getCity(), PDO::PARAM_STR);
  $query->bindValue(':id', $address->getId(), PDO::PARAM_STR);
  $query->execute();
  header("location:../my-addresses.php");
}

function delete($id)
{
  $pdo = Connection::getInstance();
  $query = $pdo->prepare('DELETE FROM addresses WHERE id=:id;');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  header("location:../my-addresses.php");
}