<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pizzas extends CI_Controller {

  private $is_admin;

  private $viewData;
  private $view;

  function __construct(){
    parent::__construct();

    $this -> load -> model('Admin_model');
    $this -> is_admin = $this -> Admin_model -> checkLogin();

    $this -> load -> model('Pizzas_model');

    $this -> viewData = [];
    $this -> view = '';

    if($this -> is_admin){
      $this -> view .= 'admin/';
    }
    $this -> view .= 'pizzas/';
  }

  public function index(){
    $this -> view .= 'index';
    $this -> viewData['pizzas'] = $this -> Pizzas_model -> getAll();
    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function get($_id){
    $pizza = $this -> _get($_id);

    if($pizza == null){
      $this -> view .= 'not_found';

      redirect($this -> view);
      return;
    }
    $this -> view .= 'get';
    $this -> viewData['pizza'] = $pizza;

    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function create(){
    if($this -> input -> post()){

      $pizza = $this -> parse();

      if(!$this -> Pizzas_model -> isValid($pizza)){
        $this -> view .= 'create';
        $this -> viewData['errors'] = "cannot_add";
      } else {
        if($this -> Pizzas_model -> add($pizza)){
          $this -> view .= 'create-success';
        } else {
          $this -> view .= 'create';
          $this -> viewData['errors'] = "cannot_add";
        }
      }

    } else {
      $this -> view .= 'create';
    }

    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function update($_id){
    $pizza = $this -> checkIfExists($_id);
    $this -> view .= 'update';

    if($this -> input -> post()){
      $pizza = $this -> parse();
      if(!$this -> Pizzas_model -> isValid($pizza)){
        $this -> viewData['errors'] = 'cannot_update';
      } else {
        if(!$this -> Pizzas_model -> update($pizza)){
          $this -> viewData['errors'] = 'cannot_update';
        } else {
          $this -> viewData['success'] = 'updated';
          $pizza = $this -> _get($_id);
        }
      }
    }
    $this -> viewData['pizza'] = $pizza;

    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function delete($_id){
    $pizza = $this -> checkIfExists($_id);

    if($this -> input -> post()){
      if(!$this -> Pizzas_model -> delete($pizza)){
        $this -> viewData['errors'] = 'cannot_delete';
        $this -> view .= 'delete';
      } else {
        $this -> view .= 'delete-success';
      }
    } else {
      $this -> view .= 'delete';
    }

    $this -> viewData['pizza'] = $pizza;
    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function not_found(){
    $this -> view .= 'not_found';

    $this -> load -> view($this -> view);
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
      'id' => $this -> input -> post_get('id'),
      'name' => $this -> input -> post('name'),
      'description' => $this -> input -> post('description')
    ];

    return (object) $pizza;
  }

  private function checkIfExists($_id){
    $pizza = $this -> _get($_id);
    if($pizza == null){
      $this -> view .= 'not_found';
      redirect($this -> view);
      return;
    }

    return $pizza;
  }
}
