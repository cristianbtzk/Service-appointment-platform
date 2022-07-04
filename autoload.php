<?php
spl_autoload_register(function ($class) {
  if (file_exists(__DIR__."/classes".DIRECTORY_SEPARATOR.$class.".class.php"))
    require_once(__DIR__."/classes".DIRECTORY_SEPARATOR.$class.".class.php");
});
?>