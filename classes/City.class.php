<?php
  include_once('AbsIdDescription.class.php');
  include_once('State.class.php');

  class City extends AbsId{
    private $name;
    private $state;

    function __construct($state, $name, $id)
    {
      parent::__construct($id);
      $this->setState($state);
      $this->setName($name);

    }

    function getName() {
      return $this->name;
    }

    function setName($name) {
      $this->name = $name;
    }

    function getState() {
      return $this->state;
    }

    function setState($state) {
      $this->state = $state;
    }
  }
?>