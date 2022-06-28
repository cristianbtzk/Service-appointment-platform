<?php
  abstract class AbsId {
    private $id;

    public function __construct($id)
    {
      $this->setId($id);
    }

    function getId() {
      return $this->id;
    }

    function setId($id) {
      $this->id = $id;
    }
  }
?>