<?php

$stylesTree = array(
  'style' => array(
    'attributes' => array(
      'rel' => 'stylesheet',
      'href' => CURRENT_URL.'/fly_fs/css/style.css'
    ),
  ),
);

function styles_build($stylesTree){
  //building menu
  $styles = '';
  foreach($stylesTree as $name => $data){
    //attributes check and take
    $attributes = '';
    foreach($data['attributes'] as $attr => $val){
      $attributes .= ' '.$attr.'="'.$val.'"';
    }
    $styles .= '<link name="'.$name.'" '.$attributes.' />';
  }
  return $styles;
}

$styles = styles_build($stylesTree);