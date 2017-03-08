<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pizzas extends CI_Controller {

  private $_is_admin;

  function __construct(){
    parent::__construct();

    $this -> load -> model('Admin_model');
    $this -> _is_admin = $this -> Admin_model -> checkLogin();

    $this -> load -> model('Pizzas_model');
  }

  public function index(){
    $pizzas = $this -> Pizzas_model -> getAll();

    if($this -> _is_admin){
      $this -> load -> view('admin/pizzas/index', [
          'pizzas' => $pizzas
      ]);
    } else {
      echo "Welcome";
    }
  }

  public function get($_id){

    $pizza = $this -> Pizzas_model -> get($_id);

    if($pizza !== null){
      $this -> load -> model('Components_model');
      $this -> load -> model('Sizes_model');

      $pizza -> components = $this -> Components_model -> getByPizzaId($pizza -> id);
      $pizza -> sizes = $this -> Sizes_model -> getByPizzaId($pizza -> id);

      if($this -> _is_admin){
        $this -> load -> view('admin/pizzas/get', [
            'pizza' => $pizza
        ]);
      } else {
        $this -> load -> view('pizzas/get', [
            'pizza' => $pizza
        ]);
      }
    } else {
      if($this -> _is_admin){
        $this -> load -> view('admin/pizzas/notfound');
      } else {
        $this -> load -> view('pizzas/notfound');
      }
    }


  }
}
