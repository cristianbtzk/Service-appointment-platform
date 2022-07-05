<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . "/autoload.php";
require __DIR__ . '/controllers/service.php';

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
      <a href="new-service.php">Novo</a><br>
      <table>
        <thead>
          <th>Id</th>
          <th>Categoria</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Data mínima</th>
          <th>Data máxima</th>
        </thead>
        <tbody>
          <?php
          try {
            $services = findByUser($_SESSION['userId']);
            foreach ($services as $service) {
          ?>
              <tr>
                <td>
                  <?=$service->getId() ?>
                </td>
                <td>
                  <?php echo
                    $service->getCategory() ?>
                </td>
                <td>
                  <?php echo
                    $service->getTitle() ?>
                </td>
                <td>
                  <?php echo
                    $service->getDescription() ?>
                </td>
                <td>
                  <?php echo
                    $service->getMinDate() ?>
                </td>
                <td>
                  <?php echo
                    $service->getMaxDate() ?>
                </td>
                <td>
                  <a href="new-service.php?operation=update&id=<?=$service->getId() ?>">Alterar</a>
                  <a href="javascript:remove('controllers/service.php?action=delete&id=<?= $service->getId() ?>')">Deletar</a>
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