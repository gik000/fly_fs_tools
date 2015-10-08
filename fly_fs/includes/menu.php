<?php
/**
 * Default menu
 */
$menuTree = array(
  'download' => array(
    'type' => 'action',
  ),
  'extract' => array(
    'type' => 'action',
  )
);
/**
 * @param $menuTree
 *
 * @return string
 */
function menu_build($menuTree){
  //checking current action to set default
  if(isset($action) && isset($menuTree[$action])){
    $menuTree[$action]['active'] = 'active';
  }
  //building menu
  $menu = '<ul>';
  foreach($menuTree as $path => $data){
    $action ='?a='.$path ;
    $class = $data['type'].' ';
    $class .= isset($data['active']) ? ' '.$data['active'] : '';
    $menu .= '<li><a href="'.CURRENT_URL_FULL.$action.'" class="'.$class.'">'.ucwords($path).'</a></li>';
  }
  $menu .= '</ul>';
  return $menu;
}
//building menu
$menu = menu_build($menuTree);