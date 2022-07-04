<?php
  include_once 'AbsId.php';

  class Message extends AbsId{
    private $text;
    private $date;
    private $from;
    private $to;
    private $service;

    function __construct($service, $to, $from, $date, $text, $id)
    {
      parent::__construct($id);
      $this->setService($service);
      $this->setTo($to);
      $this->setFrom($from);
      $this->setDate($date);
      $this->setText($text);
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }
  }
