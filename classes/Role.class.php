<?php
  include_once('AbsIdDescription.php');

  class Role extends AbsIdDescription{

    function __construct($description, $id)
    {
      parent::__construct($description, $id);
    }
  }

?>