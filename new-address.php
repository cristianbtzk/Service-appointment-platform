<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once __DIR__ . "/controllers/address.php";
require_once __DIR__ . "/controllers/state.php";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <div class="categories-container">
    <?php include('./menu.php') ?>
    <form action="controllers/address.php" method="POST">
      <input type="text" name="id" style="display: none;" value=<?php echo !$address ? null : $address->getId() ?>>
      <input type="number" name="house_number" placeholder="Número da casa" value=<?php echo !$address ? null : $address->getHouseNumber() ?>>
      <input type="text" name="street" placeholder="Rua" value=<?php echo !$address ? null : $address->getStreet() ?>>
      <input type="text" name="postal_code" placeholder="CEP" value=<?php echo !$address ? null : $address->getPostalCode() ?>>
      <input type="text" name="district" placeholder="Bairro" value=<?php echo !$address ? null : $address->getDistrict() ?>>
      <select id="state" name="state_id">
        <?php
        foreach (findAllStates() as  $state) {
        ?>
          <option value=<?= $state->getId() ?>><?= $state->getName() ?></option>
        <?php
        }
        ?>
      </select>
      <select id="city" name="city_id"></select>

      <button type="submit" name="action" value=<?= $operation ?>>Enviar</button>

    </form>
  </div>


</body>

</html>
<script>
  $("#state").on("change", () => {
    const stateId = $("#state").val();

    $.ajax({
      url: 'controllers/city.php',
      type: 'POST',
      data: {
        stateId,
        action: 'getCitiesByStateId'
      },
      success: (data) => {
        $("#city").html(data)
      }
    })
  })
</script>