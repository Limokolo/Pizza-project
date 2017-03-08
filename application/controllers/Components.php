<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/class/Component.php';

class Components extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this -> load -> model('Components_model');
  }

  public function index(){
    $this -> load -> view('components/index', [
        'components' => $this -> Components_model -> getAll()
    ]);
  }
}
