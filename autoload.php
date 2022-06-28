<?php
spl_autoload_register(function ($class) {
  if (file_exists("classes".DIRECTORY_SEPARATOR.$class.".class.php"))
    require_once("classes".DIRECTORY_SEPARATOR.$class.".class.php");
});
?>