<!DOCTYPE html>
<html lang="en">
<?php 
  require_once __DIR__ . "/controllers/category.php";
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
    <form action="controllers/service.php" method="POST">
      <input type="text" name="title" placeholder="Título">
      <input type="text" name="description" placeholder="Descrição">
      <input type="datetime-local" name="min-date" placeholder="Data mĩnima">
      <input type="datetime-local" name="max-date" placeholder="Data Máxima">
      <select name="category_id">
        <?php
          foreach(findAll() as  $category) {
            ?>
              <option value=<?=$category->getId() ?>><?=$category->getTitle() ?></option>
            <?php
          }
        ?>
      </select>
      <button type="submit" name="action" value="create">Cadastrar</button>

    </form>
  </div>
</body>

</html>