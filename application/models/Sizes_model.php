<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Sizes_model extends CI_model {
  function __construct(){
    parent::__construct();

    $this -> load -> database();
  }


  public function getAll(){
    $sizes = $this -> db -> get('sizes');

    if($sizes -> num_rows() > 0){
      return $sizes -> result('sizes');
    }

    return null;
  }

  public function getByPizzaId($_id){
    $sizes = $this -> db -> where('pizza_id', $_id) -> get('sizes');

    if($sizes -> num_rows() > 0){
      return $sizes -> result('Size');
    }

    return [];
  }


}
