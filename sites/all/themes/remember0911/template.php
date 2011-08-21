<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
 
function remember_photo($photos = NULL,$avatar=NULL) {
  if (!empty($photos)) { return $photos; }
  if (!empty($avatar)) { return $avatar; };
  
  return;
}

function remember_name($fname=NULL,$lname=NULL) {
  $name = $fname;
  if (!empty($name)) { $name = $name.' '.$lname; }
  else { $name = $lname; };
  return $name;
}

function remember_avatar($avatar) {
  if (!empty($avatar)) { return $avatar; }
  else { return path_to_theme().'/img/avatar.jpg'; };
}

function remember0911_preprocess_page(&$vars) {
  drupal_add_css(path_to_theme() . '/css/ie8.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 8', '!IE' => FALSE), 'preprocess' => FALSE));
  drupal_add_js("http://use.typekit.com/bzr8kzw.js",'external');
  drupal_add_js('try{Typekit.load();}catch(e){}','inline');
}

function remember0911_user_view_alter(&$build) {
  
 }

function remember0911_preprocess_user_profile(&$vars) {
  $vars['element']['#title'] = '';
  if (!empty($vars['field_fname'][0]['safe_value'])) { $name = $vars['field_fname'][0]['safe_value']; };
  $name = $vars['field_fname'][0]['safe_value'];
  if (!empty($name)) { $name = $name.' '.$vars['field_lname'][0]['safe_value']; } else { $name = $vars['field_fname'][0]['safe_value']; };
  if (empty($name)) { $name = 'Guest'; };
  $name = $vars['elements']['#account']->name;
  $vars['fullname'] = $name;
  $vars['uid'] = $vars['elements']['#account']->uid;
  $vars['user_created'] = $vars['elements']['#account']->created;
  drupal_set_title($name."'s story");
  $vars['page_title'] = '';
  
}

function remember0911_theme($existing, $type, $theme, $path){
  return array(
    'user_register' => array(
      'render element' => 'form',
      'template' => 'templates/user-register',
    ),
    'user_profile_form' => array(
      'render element' => 'form',
      'template' => 'templates/user-profile-form',
    ),
  );
}

function remember0911_preprocess_user_register(&$variables) {
  //print_r($variables['form']);
  $variables['rendered'] = drupal_render_children($variables['form']);
}
function remember0911_preprocess_user_profile_form(&$variables) {
  $variables['rendered'] = drupal_render_children($variables['form']);
}