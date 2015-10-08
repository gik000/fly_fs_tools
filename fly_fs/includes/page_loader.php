<?php

/**
 * Check actions
 */
if(isset($_GET['a']) && $_GET['a']!=''){
  $action = $_GET['a'];
  ob_start(); // turn on output buffering
  include(CURRENT_PATH.'/fly_fs/actions/'.$action.'.php');
  $content = ob_get_contents(); // get the contents of the output buffer
  ob_end_clean(); //  clean (erase) the output buffer and turn off output buffering
} else {
  //DEFAULT
  $content = '';
}