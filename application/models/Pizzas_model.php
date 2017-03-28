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
      $pizza = $component -> result('Pizza')[0];
      return $pizza;
    }

    return null;
  }

  public function getAll(){
    $result = $this -> db -> get('pizza');

    if($result -> num_rows() > 0){
      $pizzas = $result -> result('Pizza');
      return $pizzas;
    }

    return null;
  }

  public function isValid($pizza){
    if(!isset($pizza -> name) || empty($pizza -> name)){
      return false;
    }

    return true;
  }

  public function create($pizza){
    $this -> db -> insert('pizza', $pizza);
    return $this -> db -> affected_rows() > 0;
  }

  public function update($pizza){
    $this -> db -> trans_start();
    $this -> db -> where('id', $pizza -> id) -> update('pizza', $pizza);
    $this -> db -> trans_complete();

    if ($this -> db -> trans_status() === FALSE) {
      return false;
    }

    return true;
  }

  public function delete($pizza){
    $this -> db -> where('id', $pizza -> id) -> delete('pizza');
    $this -> db -> where('pizza_id', $pizza -> id) -> delete('components_in_pizza');
    return $this -> db -> affected_rows() > 0;
  }

  public function addComponent($component, $pizza){
    $this -> db -> insert('components_in_pizza', ['pizza_id' => $pizza -> id, 'component_id' => $component -> id]);
    return $this -> db -> affected_rows() > 0;
  }

  public function removeComponent($component, $pizza){
    $this -> db -> where('component_id', $component -> id) -> where('pizza_id', $pizza -> id) -> delete('components_in_pizza');
    return $this -> db -> affected_rows() > 0;
  }
}
