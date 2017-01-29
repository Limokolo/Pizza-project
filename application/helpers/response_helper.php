<?php

function response($message){
  if(isset($_GET['format']) && !empty($_GET['format'])){
    switch($_GET['format']){
        case 'json':
          header('Content-Type: application/json');
          print_r(json_encode($message));
          break;
        default:
          print_r($message);
          break;
    }
  } else {
    print_r($message);
  }

}
