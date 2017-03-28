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
    $this -> load -> model('Components_model');
    $this -> load -> model('Sizes_model');

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

    if($this -> session -> has_userdata('errors')){
      $this -> viewData['errors'] = $this -> session -> errors;
      $this -> session -> unset_userdata('errors');
    }

    if($this -> session -> has_userdata('success')){
      $this -> viewData['success'] = $this -> session -> success;
      $this -> session -> unset_userdata('success');
    }

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
    $this -> viewData['components'] = [];
    $components = $this -> Components_model -> getAll();
    foreach($components as $component){
      if(!in_array($component, $pizza -> components)){
        $this -> viewData['components'][] = $component;
      }
    }
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

  public function addComponent($_id){
    $this -> view .= 'update/' . $_id;
    $pizza = $this -> checkIfExists($_id);

    if($this -> input -> post()){
      $component_id = $this -> input -> post('component_id');
      $component = $this -> Components_model -> get($component_id);
      if($component !== null){ // Składnik istnieje
        if($this -> Pizzas_model -> addComponent($component, $pizza)){ // Dodano składnik
          $this -> session -> success = 'component_added';
        } else { // Nie dodano składnika
          $this -> session -> error = 'cannot_add_component';
        }
      } else { // Składnik nie istnieje
        $this -> session -> error = 'component_not_exists';
      }

    }

    redirect($this -> view);
    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function removeComponent($_id, $_component_id){
    $this -> view .= 'update/' . $_id;
    $pizza = $this -> checkIfExists($_id);

    $component = $this -> Components_model -> get($_component_id);
    if($component !== null){ // Składnik istnieje
      if($this -> Pizzas_model -> removeComponent($component, $pizza)){ // Dodano składnik
        $this -> session -> success = 'component_added';
      } else { // Nie dodano składnika
        $this -> session -> error = 'cannot_remove_component';
      }
    } else { // Składnik nie istnieje
      $this -> session -> error = 'component_not_exists';
    }

    redirect($this -> view);
    $this -> load -> view($this -> view, $this -> viewData);
  }

  private function _get($_id){
    $pizza = $this -> Pizzas_model -> get($_id);
    if($pizza === null){
      return null;
    }

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
