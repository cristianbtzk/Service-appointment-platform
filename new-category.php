<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/categories.css">
  <title>Document</title>
</head>

<body>
  <div class="categories-container">
    <?php include('./menu.php') ?>
    <form action="controllers/category.php" method="POST">
      <input type="text" name="title" placeholder="Categoria">
      <input type="text" name="description" placeholder="Descrição">
      <button type="submit" name="action" value="create">Cadastrar</button>
    </form>
  </div>
</body>

</html>