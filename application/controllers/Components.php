<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Components extends CI_Controller {
  function __construct(){
    parent::__construct();

    $this -> load -> model('Components_model');

    $this -> load -> model('Admin_model');
    $this -> _is_admin = $this -> Admin_model -> checkLogin();
  }

  public function index(){
    if($this -> _is_admin){
      $this -> load -> view('admin/components/index', [
          'components' => $this -> Components_model -> getAll()
      ]);
    } else {
      $this -> load -> view('components/index', [
          'components' => $this -> Components_model -> getAll()
      ]);
    }
  }

  public function create(){
    if($this -> input -> post()){
      $component = $this -> parse();

      if(!$this -> Components_model -> isValid($component)){
        $this -> load -> view('admin/components/create', [
            'erors' => 'cannot_add',
            'component' => $component
        ]);
      } else {
        if(!$this -> Components_model -> create($component)){
          $this -> load -> view('admin/components/create', [
              'erors' => 'cannot_add',
              'component' => $component
          ]);
        } else {
          $this -> load -> view('admin/components/create', [
              'success' => 'added',
              'component' => $component
          ]);
        }
      }

    } else {
      $this -> load -> view('admin/components/create');
    }
  }


  public function update($_id){

    if($this -> input -> post()){
      $component = $this -> parse();

      if(!$this -> Components_model -> isValid($component)){
        $this -> load -> view('admin/components/update', [
            'erors' => 'cannot_update',
            'component' => $this -> Components_model -> get($_id)
        ]);
      } else {
        if(!$this -> Components_model -> update($component)){
          $this -> load -> view('admin/components/update', [
              'erors' => 'cannot_update',
              'component' => $this -> Components_model -> get($_id)
          ]);
        } else {
          $this -> load -> view('admin/components/update', [
              'success' => 'updated',
              'component' => $this -> Components_model -> get($_id)
          ]);
        }
      }

    } else {
      if($this -> _is_admin){
        $this -> load -> view('admin/components/update', [
            'component' => $this -> Components_model -> get($_id)
        ]);
      } else {
        $this -> load -> view('components/update', [
            'component' => $this -> Components_model -> get($_id)
        ]);
      }
    }
  }

  public function delete($_id){
    $component = $this -> Components_model -> get($_id);
    if($component != null){
      if($this -> input -> post()){
        if(!$this -> Components_model -> delete($component)){
          $this -> load -> view('admin/components/delete', ['errors' => 'cannot_delete']);
        } else {
          $this -> load -> view('admin/components/delete', ['success' => 'deleted']);
        }
      } else {
        $this -> load -> view('admin/components/delete', [
            'component' => $component
        ]);
      }
    } else {
      echo '<h1>Nie znaleziono składnika</h1>';
    }
  }

  private function parse(){
    $component = [
      'id' => $this -> input -> post('id'),
      'name' => $this -> input -> post('name')
    ];

    return (object) $component;
  }
}
