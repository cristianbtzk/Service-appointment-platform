<?php
  include_once('AbsId.class.php');
  class Address extends AbsId{
    private $houseNumber;
    private $street;
    private $postalCode;
    private $district;
    private $user;
    private $city;

    function __construct($houseNumber, $street, $postalCode, $district, $user, $city, $id = null)
    {
      parent::__construct($id);
      $this->setHouseNumber($houseNumber);
      $this->setStreet($street);
      $this->setPostalCode($postalCode);
      $this->setDistrict($district);
      $this->setUser($user);
      $this->setCity($city);
    }


    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function setDistrict($district)
    {
        $this->district = $district;

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

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
  }
