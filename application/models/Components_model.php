<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Components_model extends CI_model {

  function __construct(){
    parent::__construct();

    $this -> load -> database();
  }

  public function get($_id){
    $component = $this -> db -> where('id', $_id) -> get('components');

    if($component -> num_rows() > 0){
      return $component -> result('Component')[0];
    }

    return null;
  }

  public function getAll(){
    $component = $this -> db -> get('components');

    if($component -> num_rows() > 0){
      return $component -> result('Component');
    }

    return null;
  }

  public function getByPizzaId($_id){
    $components = $this -> db
      -> from('components_in_pizza as cip')
      -> where('cip.pizza_id', $_id)
      -> join('components', 'components.id = cip.component_id')
      -> select('components.*')
      -> get();

    if($components -> num_rows() > 0){
      return $components -> result('Component');
    }

    return [];
  }

  public function add($component){
    $this -> db -> insert('components', $component);
    return $this -> db -> affected_rows() > 0;
  }

  public function update($component){
    $this -> db -> trans_start();
    $this -> db -> where('id', $component -> id) -> update('components', $component);
    $this -> db -> trans_complete();

    if ($this -> db -> trans_status() === FALSE) {
      return false;
    }

    return true;
  }

  public function delete($component){
    $this -> db -> where('id', $component -> id) -> delete('components');
    $this -> db -> where('component_id', $component -> id) -> delete('components_in_pizza');
    return $this -> db -> affected_rows() > 0;
  }

  public function isValid($component){
    if(!isset($component -> name) || empty($component -> name)){
      return false;
    }
    return true;
  }

}
