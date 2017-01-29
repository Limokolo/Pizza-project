<?php

class Pizza {

  public $id;
  public $name;

  public $cake;
  public $components;
  public $notes;

  public $price;
  public $discount;

  function __construct(){
    $this -> calculatePrice();
  }

  public function calculatePrice(){
    $this -> price = 0;
    if(!empty($this -> components)){
      foreach($this -> components as $component){
        $this -> price += ( $component -> price * $component -> count );
      }
    }

    if($this -> discount !== NULL){
      $discount = str_replace(',', '.', $this -> discount);
      $discount = floatval($discount);

      if(strpos($this -> discount, '%')){
        $discount = rtrim($discount, '%');
        $discount /= 100;
        $discount = $this -> price * $discount;
      }

      $this -> price -= $discount;
      $this -> price = round($this -> price, 2);
    }
  }
}
