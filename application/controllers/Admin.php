<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this -> load -> model('Admin_model');
  }

  public function index(){

    if(!$this -> Admin_model -> checkLogin()){
      redirect(base_url('admin/login'));
    }

    $this -> load -> view('admin/index');
  }

  public function login(){

    $errors = array();

    if($this -> input -> post()){
      $login = $this -> input -> post('login');
      $password = $this -> input -> post('password');

      $pass = true;
      if($login === null || empty($login)){
        $errors['empty_login'] = true;
        $pass = false;
      }

      if($password === null || empty($password)){
        $errors['empty_password'] = true;
        $pass = false;
      }

      if($pass){
        if($this -> Admin_model -> validate($login, $password)){
          redirect(base_url('admin/index'));
        }
      }

    } else {
      if($this -> Admin_model -> checkLogin()){
        redirect(base_url('admin/index'));
      }
    }
    $this -> load -> view('admin/login', [
      'errors' => $errors
    ]);
  }

  public function logout(){
    $this -> Admin_model -> logout();
    redirect(base_url('admin/login'));
  }

}
