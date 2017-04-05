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

    $pizza = $this -> _get($_id);

    if($pizza !== null){
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

  public function create(){
    if($this -> input -> post()){

      $pizza = $this -> parse();

      if(!$this -> Pizzas_model -> isValid($pizza)){
        $this -> load -> view('admin/pizzas/create', ['errors' => 'cannot_add']);
      } else {
        if(!$this -> Pizzas_model -> add($pizza)){
          $this -> load -> view('admin/pizzas/create', ['errors' => 'cannot_add']);
        } else {
          $this -> load -> view('admin/pizzas/create-success');
        }
      }

    } else {
      $this -> load -> view('admin/pizzas/create');
    }
  }

  public function update($_id){
    if(!$this -> _is_admin){
      redirect(base_url('pizzas/index'));
      return;
    }

    if($this -> input -> post()){

      $pizza = $this -> parse();
      if(!$this -> Pizzas_model -> isValid($pizza)){
        $this -> load -> view('admin/pizzas/update', ['errors' => 'cannot_update', 'pizza' => $this -> _get($_id)]);
      } else {
        if(!$this -> Pizzas_model -> update($pizza)){
          $this -> load -> view('admin/pizzas/update', ['errors' => 'cannot_update', 'pizza' => $this -> _get($_id)]);
        } else {
          $this -> load -> view('admin/pizzas/update', ['success' => 'updated', 'pizza' => $this -> _get($_id)]);
        }
      }
    } else {
      $pizza = $this -> _get($_id);

      if($pizza !== null){
        $this -> load -> view('admin/pizzas/update', [
            'pizza' => $pizza
        ]);
      } else {
        $this -> load -> view('admin/pizzas/notfound');
      }
    }
  }

  public function delete($_id){
    $pizza = $this -> _get($_id);

    if($this -> input -> post()){
      if(!$this -> Pizzas_model -> delete($pizza)){
        $this -> load -> view('admin/pizzas/delete', ['errors' => 'cannot_delete']);
      } else {
        $this -> load -> view('admin/pizzas/delete-success');
      }
    } else {
      if($pizza !== null){
        $this -> load -> view('admin/pizzas/delete', [
            'pizza' => $pizza
        ]);
      } else {
        $this -> load -> view('admin/pizzas/notfound');
      }
    }
  }

  private function _get($_id){
    $pizza = $this -> Pizzas_model -> get($_id);
    if($pizza === null){
      return null;
    }

    $this -> load -> model('Components_model');
    $this -> load -> model('Sizes_model');

    $pizza -> components = $this -> Components_model -> getByPizzaId($pizza -> id);
    $pizza -> sizes = $this -> Sizes_model -> getByPizzaId($pizza -> id);

    return $pizza;
  }

  private function parse(){
    $pizza = [
      'id' => $this -> input -> post('id'),
      'name' => $this -> input -> post('name'),
      'description' => $this -> input -> post('description')
    ];

    return (object) $pizza;
  }
}
