<?php
  include_once __DIR__ . '/AbsIdDescription.class.php';

  class Service extends AbsIdDescription{
    private $title;
    private $description;
    private $minDate;
    private $maxDate;
    private $user;
    private $category;
    private $status;

    function __construct($status, $title, $category, $user, $maxDate, $minDate, $description, $id = null)
    {
      parent::__construct($description, $id);
      $this->setStatus($status); 
      $this->setTitle($title); 
      $this->setCategory($category); 
      $this->setUser($user); 
      $this->setMaxDate($maxDate); 
      $this->setMinDate($minDate); 
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getMinDate()
    {
        return $this->minDate;
    }

    public function setMinDate($minDate)
    {
        $this->minDate = $minDate;

        return $this;
    }

    public function getMaxDate()
    {
        return $this->maxDate;
    }

    public function setMaxDate($maxDate)
    {
        $this->maxDate = $maxDate;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
  }
