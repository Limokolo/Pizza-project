<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/class/Component.php';

class Components extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this -> load -> model('Components_model');
    $this -> load -> helper('response');
  }

  public function index(){
    $this -> load -> view('components/index', [
        'components' => $this -> Components_model -> getAll()
    ]);
  }

  public function get($_id = null){
    $this -> isAllowed();

    if($_id !== null) {
      $component = $this -> Components_model -> get($_id);
      if($component !== null){
        response($component);
      } else {
        http_response_code(404);
      }
    } else {
      http_response_code(400);
    }
  }

  public function add(){
    $this -> isAllowed();

    $component = new Component($this -> input -> post('name'), $this -> input -> post('price'));

    if(!$component -> isValid()){
      http_response_code(400);
      return;
    }

    $newComponent = $this -> Components_model -> add($component);
    if($newComponent === false){
      http_response_code(302);
      return;
    }
    response($newComponent);
  }

  private function isAllowed(){
    if(!$this -> input -> is_ajax_request() && !$this -> input -> get('format')){
      http_response_code(403);
      exit;
    }
  }

}
