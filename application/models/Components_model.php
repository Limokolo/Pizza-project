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


  public function checkIfExists($id){
    $result = $this -> db -> where('id', $id) -> get('components');
    return $result -> num_rows() > 0;
  }

  public function add(Component $_component){
    $component = $this -> db -> where('name', $_component -> name) -> get('components');
    $exists =  $component -> num_rows() > 0;

    if($exists){
      return false;
    }

    $this -> db -> insert('components', $_component);
    $id = $this -> db -> insert_id();
    return $this -> get($id);
  }

}
