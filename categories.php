<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . "/conf/Connection.php";
require_once __DIR__ . "/autoload.php";
$pdo = Connection::getInstance();
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
      <a href="new-category.php">Nova</a><br>
      <table>
        <thead>
          <th>Id</th>
          <th>Categoria</th>
          <th>Descricao</th>
          <th>Ações</th>
        </thead>
        <tbody>
          <?php
          try {
            $consulta = $pdo->prepare('SELECT * FROM categories ORDER BY title;');
            $consulta->execute();
            while ($result = $consulta->fetch(PDO::FETCH_ASSOC)) {
              $category = new Category($result['title'], $result['description'], $result['id']);
          ?>
              <tr>
                <td>
                  <?php echo
                    $category->getId() ?>
                </td>
                <td>
                  <?php echo
                    $category->getTitle() ?>
                </td>
                <td>
                  <?php echo
                    $category->getDescription() ?>
                </td>
                <td>
                  <a href="new-category.php?operation=update&id=<?=$category->getId() ?>">Alterar</a>
                  <a href="javascript:remove('controllers/category.php?action=delete&id=<?= $category->getId() ?>')">Deletar</a>
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