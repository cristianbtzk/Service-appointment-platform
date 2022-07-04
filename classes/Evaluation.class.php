<?php
  include_once 'AbsId.php';

  class Evaluation extends AbsId{
    private $rating;
    private $comment;
    private $author;
    private $subject;
    private $service;

    function __construct($service, $subject, $author, $comment, $rating, $id)
    {
      parent::__construct($id);
      $this->setService($service);
      $this->setSubject($subject);
      $this->setAuthor($author);
      $this->setComment($comment);
      $this->setRating($rating);
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

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
