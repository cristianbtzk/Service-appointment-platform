<?php
  include_once('AbsIdDescription.php');
  include_once('State.class.php');

  class City extends AbsId{
    private $name;
    private State $state;

    function __construct(State $state, $name, $id)
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

    function setState(State $state) {
      $this->state = $state;
    }
  }
?>