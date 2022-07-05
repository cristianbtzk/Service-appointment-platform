<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . "/autoload.php";
require __DIR__ . '/controllers/address.php';

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/categories.css">
  <script type="text/javascript" src="js/util.js"></script>
  <title>Document</title>
</head>

<body>
  <div class="categories-container">
    <?php include('./menu.php') ?>
    <div>
      <a href="new-address.php">Novo</a><br>
      <table>
        <thead>
          <th>Id</th>
          <th>Cidade</th>
          <th>Nº</th>
          <th>Rua</th>
          <th>CEP</th>
          <th>Bairro</th>
        </thead>
        <tbody>
          <?php
          try {
            $addresses = findAll();
            foreach ($addresses as $address) {
          ?>
              <tr>
                <td>
                  <?=$address->getId() ?>
                </td>
                <td>
                  <?php echo
                    $address->getCity() ?>
                </td>
                <td>
                  <?php echo
                    $address->getHouseNumber() ?>
                </td>
                <td>
                  <?php echo
                    $address->getPostalCode() ?>
                </td>
                <td>
                  <?php echo
                    $address->getDistrict() ?>
                </td>
                <td>
                  <a href="new-address.php?operation=update&id=<?=$address->getId() ?>">Alterar</a>
                  <a href="javascript:remove('controllers/address.php?action=delete&id=<?= $address->getId() ?>')">Deletar</a>
                </td>
              </tr>
          <?php
            }
          } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>