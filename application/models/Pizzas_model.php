<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pizzas_model extends CI_model {

  function __construct(){
    parent::__construct();

    $this -> load -> database();
  }

  public function get($_id){
    $component = $this -> db -> where('id', $_id) -> get('pizza');

    if($component -> num_rows() > 0){
      return $component -> result('Pizza')[0];
    }

    return null;
  }

  public function getAll(){
    $result = $this -> db -> get('pizza');

    if($result -> num_rows() > 0){
      return $result -> result('Pizza');
    }

    return null;
  }

  public function getComponents(Pizza $pizza){
    $result = $this -> db -> select('comp.*, cip.count') -> from('components_in_pizza as cip') -> where('pizza_id', $pizza -> id) -> join('components as comp', 'comp.id = cip.component_id') -> get();
    return $result -> result();
  }

}
