<?php

$debug = (isset($_POST['debugMode']))? true : false;

if($debug){
  // Same as error_reporting(E_ALL);
  ini_set('error_reporting', E_ALL);

  if(isset($_POST)){
    print_r($_POST);
  }
}