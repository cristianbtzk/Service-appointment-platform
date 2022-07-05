<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . "/controllers/address.php";
$operation = isset($_GET['operation']) ? $_GET['operation'] : 'create';
$address = null;
if ($operation == 'update') {
  $address = findById($_GET['id']);
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/categories.css">
  <title>Document</title>
</head>

<body>
  <div class="categories-container">
    <?php include('./menu.php') ?>
    <form action="controllers/address.php" method="POST">
      <input type="text" name="id" style="display: none;" value=<?php echo !$address ? null : $address->getId() ?>>
      <input type="number" name="house_number" placeholder="Número da casa" value=<?php echo !$address ? null : $address->getHouseNumber() ?>>
      <input type="text" name="street" placeholder="Rua" value=<?php echo !$address ? null : $address->getStreet() ?>>
      <input type="text" name="postal_code" placeholder="CEP" value=<?php echo !$address ? null : $address->getPostalCode() ?>>
      <input type="text" name="district" placeholder="Bairro" value=<?php echo !$address ? null : $address->getDistrict() ?>>
      <input type="text" name="city_id" placeholder="Cidade" value=<?php echo !$address ? null : $address->getCity() ?>>

      <button type="submit" name="action" value=<?=$operation ?>>Enviar</button>

    </form>
  </div>
</body>

</html>