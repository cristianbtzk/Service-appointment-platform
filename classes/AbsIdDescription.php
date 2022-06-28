<?php
  abstract class AbsIdDescription extends AbsId {
    private $description;

    public function __construct($description, $id)
    {
      $this->setDescription($description);
      parent::__construct($id);
    }

    function getDescription() {
      return $this->description;
    }

    function setDescription($description) {
      $this->description = $description;
    }
  }
?>