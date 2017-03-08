<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pizzas extends CI_Controller {

  private $_is_admin;

  function __construct(){
    parent::__construct();

    $this -> _is_admin = strpos($_SERVER['REQUEST_URI'], 'admin') !== false;

    $this -> load -> model('Pizzas_model');
  }

  public function index(){
    $pizzas = $this -> Pizzas_model -> getAll();

    $this -> load -> model('Components_model');
    $this -> load -> model('Sizes_model');
    foreach($pizzas as $p){
      $p -> components = $this -> Components_model -> getByPizzaId($p -> id);
      $p -> sizes = $this -> Sizes_model -> getByPizzaId($p -> id);
    }

    if($this -> _is_admin){
      print_r($pizzas);
    } else {
      echo "Welcome";
    }


    // $this -> load -> view('pizzas/index', [
    //     'is_admin' => $this -> _is_admin,
    //     'pizzas' => $pizzas
    // ]);
  }
}
