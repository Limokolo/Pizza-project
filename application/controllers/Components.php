<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Components extends CI_Controller {

  private $is_admin;

  private $viewData;
  private $view;

  function __construct(){
    parent::__construct();

    $this -> load -> model('Admin_model');

    $this -> is_admin = $this -> Admin_model -> checkLogin();
    $this -> load -> model('Components_model');

    $this -> viewData = [];
    $this -> view = '';

    if($this -> is_admin){
      $this -> view = 'admin/';
    }
    $this -> view .= 'components/';
  }

  public function index(){
    $this -> view .= 'index';
    $this -> viewData['components'] = $this -> Components_model -> getAll();

    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function create(){
    if($this -> input -> post()){ // To jest wysłanie formularza
      $_component = $this -> parse();
      if($this -> Components_model -> isValid($_component)){ // Składnik jest poprawny
        if($this -> Components_model -> add($_component)){ // Aktualizacja powiodła się
          $this -> viewData['success'] = 'component_added';
        } else { // Aktualizacja nie powiodła się
          $this -> viewData['errors'] = 'cannot_update_db';
        }
      } else { // Składnik nie jest poprawny
        $this -> viewData['errors'] = 'component_is_not_valid';
      }
    }

    $this -> view .= 'create';
    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function get($_id){
    $component = $this -> checkIfExists($_id);

    $this -> view .= 'get';
    $this -> viewData['component'] = $component;

    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function update($_id){
    $component = $this -> checkIfExists($_id);

    if($this -> input -> post()){ // To jest wysłanie formularza
      $_component = $this -> parse();
      if($this -> Components_model -> isValid($_component)){ // Składnik jest poprawny
        $_component -> id = $_id;
        if($this -> Components_model -> update($_component)){ // Aktualizacja powiodła się
          $this -> viewData['success'] = 'updated';
          $component = $this -> checkIfExists($_id);
        } else { // Aktualizacja nie powiodła się
          $this -> viewData['errors'] = 'cannot_update_db';
        }
      } else { // Składnik nie jest poprawny
        $this -> viewData['errors'] = 'component_is_not_valid';
      }
    }

    $this -> view .= 'update';
    $this -> viewData['component'] = $component;

    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function delete($_id){
    $component = $this -> checkIfExists($_id);

    if($this -> input -> post()){ // To jest wysłanie formularza
      if($this -> Components_model -> delete($component)){ // Aktualizacja powiodła się
        $this -> viewData['success'] = 'component_deleted';
      } else { // Aktualizacja nie powiodła się
        $this -> viewData['errors'] = 'cannot_update_db';
      }

    }

    $this -> view .= 'delete';
    $this -> viewData['component'] = $component;
    $this -> load -> view($this -> view, $this -> viewData);
  }

  public function not_found(){
    $this -> view .= 'not_found';
    $this -> load -> view($this -> view);
  }

  private function parse(){
    $component = [
      'id' => $this -> input -> post_get('id'),
      'name' => $this -> input -> post('name')
    ];

    return (object) $component;
  }

  private function checkIfExists($_id){
    $component = $this -> Components_model -> get($_id);
    if($component == null){
      $this -> view .= 'not_found';

      redirect($this -> view);
      return false;
    }

    return (object) $component;
  }
}
