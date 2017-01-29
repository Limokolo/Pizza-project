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

  private function isAllowed(){
    if(!$this -> input -> is_ajax_request() && !$this -> input -> get('format')){
      http_response_code(403);
      exit;
    }
  }

}
