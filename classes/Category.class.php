<?php
  include_once('AbsIdDescription.class.php');
  class Category extends AbsIdDescription{
    private $title;

    function __construct($title, $description, $id)
    {
      $this->setTitle($title);
      parent::__construct($description, $id);
    }

    function getTitle() {
      return $this->title;
    }

    function setTitle($title) {
      $this->title = $title;
    }
  }

?>