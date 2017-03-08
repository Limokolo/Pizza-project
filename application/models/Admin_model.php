<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_model {

  public function checkLogin(){
    $is_admin = strpos($_SERVER['REQUEST_URI'], 'admin') !== false;
    if($is_admin){

      $admin_token = $this -> session -> userdata('admin_token');
      if(!empty($admin_token)){
        $is_admin = true;
      } else {
        $is_admin = false;
      }
    }

    return $is_admin;
  }

  public function validate($login, $pass){

    $correct = $login === "admin" && $pass === "admin";
    if($correct){
      $this -> session -> set_userdata('admin_token', 1);
    }
    return $correct;
  }

  public function logout(){
    $this -> session -> unset_userdata('admin_token');
  }

}
