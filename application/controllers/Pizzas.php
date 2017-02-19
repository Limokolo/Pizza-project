<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/class/Pizza.php';
require_once 'application/class/Component.php';

class Pizzas extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this -> load -> model('Pizzas_model');
    $this -> load -> helper('response');
  }

  public function index(){
    $this -> load -> view('pizzas/index', [
        'pizzas' => $this -> Pizzas_model -> getAll()
    ]);
  }

  public function get($_id = null){
    $this -> isAllowed();

    if($_id !== null) {
      $pizza = $this -> Pizzas_model -> get($_id);
      if($pizza !== null){
        response($pizza);
      } else {
        http_response_code(404);
      }
    } else {
      http_response_code(400);
    }
  }

  public function addComponent(){
    $component_id = $this -> input -> post('component_id');
    $component_count = $this -> input -> post('component_count');
    $pizza_id = $this -> input -> post('pizza_id');

    if($this -> input -> get('debug')){
      $component_id = $this -> input -> post_get('component_id');
      $component_count = $this -> input -> post_get('component_count');
      $pizza_id = $this -> input -> post_get('pizza_id');
    }

    if($component_id === null || $pizza_id === null){
      response(['error' => "Undefined component id or pizza id"]);
      http_response_code(400);
      return;
    }

    if($component_count === null){
      $component_count = 1;
    }

    $this -> load -> model('Components_model');

    if(!$this -> Pizzas_model -> checkIfExists($pizza_id) || !$this -> Components_model -> checkIfExists($component_id)){
      response(['error' => "Component or pizza not exists"]);
      http_response_code(400);
      return;
    }

    $response = $this -> Pizzas_model -> addComponent($component_id, $pizza_id, $component_count);

    if($response === false){
      response(['error' => "Cannot add component"]);
      http_response_code(500);
      return;
    }

    response($response);
  }

  private function isAllowed(){
    if(!$this -> input -> is_ajax_request() && !$this -> input -> get('format')){
      http_response_code(403);
      exit;
    }
  }

}
