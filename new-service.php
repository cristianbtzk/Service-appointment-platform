<!DOCTYPE html>
<html lang="en">
<?php 
  require_once __DIR__ . "/controllers/category.php";
  require_once __DIR__ . "/controllers/service.php";
  $operation = isset($_GET['operation']) ? $_GET['operation'] : 'create';
  $service = null;
  if ($operation == 'update') {
    $service = findServiceById($_GET['id']);
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
    <form action="controllers/service.php" method="POST">
      <input type="text" name="id" style="display: none;" value=<?php echo !$service ? null : $service->getId() ?>>
      <input type="text" name="title" placeholder="Título" value=<?php echo !$service ? null : $service->getTitle() ?>>
      <input type="text" name="description" placeholder="Descrição" value=<?php echo !$service ? null : $service->getDescription() ?>>
      <input type="datetime-local" name="min-date" placeholder="Data mĩnima" value=<?php echo !$service ? null : date('Y-m-d\TH:i', strtotime($service->getMinDate())) ?>>
      <input type="datetime-local" name="max-date" placeholder="Data Máxima" value=<?php echo !$service ? null : date('Y-m-d\TH:i', strtotime($service->getMaxDate())) ?>>
      <select name="category_id">
        <?php
          foreach(findAll() as  $category) {
            ?>
              <option value=<?=$category->getId() ?>><?=$category->getTitle() ?></option>
            <?php
          }
        ?>
      </select>
      <button type="submit" name="action" value=<?=$operation ?>>Enviar</button>

    </form>
  </div>
</body>

</html>