<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['user']))
  header("location:index.php");

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/login.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <form action="controllers/login.php" method="post">
      <h1>Login</h1>

      <label for="email">Email</label>
      <input type="text" name="email" placeholder="Email">
      <label for="password">Senha</label>
      <input type="password" name="password" placeholder="Senha">
      <a href="sign-up.php">Crie uma conta</a>
      <button type="submit" name="action" value="login">Entrar</button>
    </form>
  </div>
</body>

</html>