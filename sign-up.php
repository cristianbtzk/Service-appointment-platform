<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['user']))
  header("location:index.php");
require __DIR__."/controllers/role.php";
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/login.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <form action="controllers/user.php" method="post">
      <h1>Cadastro</h1>

      <label for="name">Nome</label>
      <input type="text" name="name" placeholder="Nome">
      <label for="email">Email</label>
      <input type="text" name="email" placeholder="Email">
      <label for="password">Senha</label>
      <input type="password" name="password" placeholder="Senha">
      <label for="cpf">CPF</label>
      <input type="text" name="cpf" placeholder="Cpf">
      <label for="cnpj">CNPJ</label>
      <input type="text" name="cnpj" placeholder="CNPJ">
      <select name="role">
        <?php
          foreach(findNonAdmin() as  $role) {
            ?>
              <option value=<?=$role->getId() ?>><?=$role->getDescription() ?></option>
            <?php
          }
        ?>
      </select>
      <button type="submit" name="action" value="create">Cadastrar</button>

    </form>
  </div>
</body>

</html>