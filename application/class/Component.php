<?php

class Component {
  public $id;
  public $name;
  public $price;

  function __construct($_name = null, $_price = null){
    if(!isset($this -> name) && $_name != null) $this -> name = $_name;
    if(!isset($this -> price) && $_price != null) $this -> price = $_price;
  }

  public function bigPizza(){
    $this -> price *= 2;
  }

  public function isValid(){
    return $this -> name !== null && $this -> price !== null;
  }
}
