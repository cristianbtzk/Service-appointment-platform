<?php
abstract class State extends AbsId
{
  private $isActive;
  private $email;
  private $name;
  private $password;
  private $cpf;
  private $cnpj;

  function __construct($name, $email, $password, $cpf, $cnpj, $isActive = true,  $id = null)
  {
    parent::__construct($id);
    $this->setName($name);
    $this->setEmail($email);
    $this->setPassword($password);
    $this->setCpf($cpf);
    $this->setCnpj($cnpj);
    $this->setIsActive($isActive);
  }

  public function getIsActive()
  {
    return $this->isActive;
  }

  public function setIsActive($isActive)
  {
    $this->isActive = $isActive;

    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  public function getCpf()
  {
    return $this->cpf;
  }

  public function setCpf($cpf)
  {
    $this->cpf = $cpf;

    return $this;
  }

  public function getCnpj()
  {
    return $this->cnpj;
  }

  public function setCnpj($cnpj)
  {
    $this->cnpj = $cnpj;

    return $this;
  }
}
