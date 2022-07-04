<?php
  include_once('AbsId.class.php');

  class State extends AbsId{
    private $name;
    private $abbreviation;

    function __construct($name, $abbreviation, $id)
    {
      parent::__construct($id);
      $this->setName($name);
      $this->setAbbreviation($abbreviation);
    }

    function getName() {
      return $this->name;
    }

    function setName($name) {
      $this->name = $name;
    }

    function getAbbreviation() {
      return $this->abbreviation;
    }

    function setAbbreviation($abbreviation) {
      $this->abbreviation = $abbreviation;
    }
  }
?>