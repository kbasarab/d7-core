<?php

/**
 * @todo
 */
function omega_tools_subtheme_wizard($subtheme, $step = NULL) {
  ctools_include('wizard');

  $info = array(
    'id' => 'omega_tools_subtheme_wizard',
    'path' => 'admin/appearance/omega-tools/edit/' . $subtheme->machine_name . '/%step',
    'show trail' => TRUE,
    'show back' => TRUE,
    'show cancel' => TRUE,
    'show return' => FALSE,
    'next text' => 'Proceed',
    'next callback' => 'omega_tools_subtheme_wizard_next',
    'finish callback' => 'omega_tools_subtheme_wizard_finish',
    'cancel callback' => 'omega_tools_subtheme_wizard_cancel',
    'order' => array(
      'info' => t('Step 1: Theme information'),
      //'grid' => t('Step 2: Custom grids'),
      //'structure' => t('Step 3: Structure'),
      //'settings' => t('Step 4: Default settings'),
      'finalize' => t('Step 5: Finalize'),
    ),
    'forms' => array(
      'info' => array(
        'form id' => 'omega_tools_subtheme_wizard_info_form',
      ),
      'grid' => array(
        'form id' => 'omega_tools_subtheme_wizard_grid_form',
      ),
      'structure' => array(
        'form id' => 'omega_tools_subtheme_wizard_structure_form',
      ),
      'settings' => array(
        'form id' => 'omega_tools_subtheme_wizard_settings_form',
      ),
      'finalize' => array(
        'form id' => 'omega_tools_subtheme_wizard_finalize_form',
      ),
    ),
  );
  
  $form_state = array('subtheme' => $subtheme);
  
  return ctools_wizard_multistep_form($info, $step, $form_state);
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_cancel(&$form_state) {
  $subtheme = &$form_state['subtheme'];

  $form_state['redirect'] = 'admin/appearance';
  
  omega_tools_cache_clear($subtheme->machine_name);
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_next(&$form_state) {
  omega_tools_cache_set($form_state['subtheme']->machine_name, $form_state['subtheme']);
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_finish(&$form_state) {
  $subtheme = $form_state['subtheme'];
  
  omega_tools_write_info_file($subtheme->machine_name, $subtheme->info, $subtheme->path);
  
  if ((!$subtheme->status || !$subtheme->default) && variable_get('theme_default') == $subtheme->machine_name) {
    $subtheme->default = FALSE;
    
    theme_enable(array('bartik'));
    variable_set('theme_default', 'bartik');
    drupal_set_message(t('%name is now the default theme.', array('%name' => 'Bartik')));
  }
  
  if ($subtheme->status || $subtheme->default) {
    theme_enable(array($subtheme->machine_name));
    
    if ($subtheme->default && variable_get('theme_default') != $subtheme->machine_name) {
      variable_set('theme_default', $subtheme->machine_name);
      drupal_set_message(t('%name is now the default theme.', array('%name' => $subtheme->name)));
    }
  }
  else {
    theme_disable(array($subtheme->machine_name));
  }
  
  omega_tools_cache_clear($subtheme->machine_name);
  drupal_set_message(t('The configuration options have been saved.'));

  $form_state['redirect'] = 'admin/appearance';
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_info_form($form, &$form_state) {
  $subtheme = $form_state['subtheme'];
  
  $form['notice']['#markup'] = '<div class="messages warning">' . t('Step 2, 3 and 4 of this subtheme wizard are still in development and will be added shortly. Once they are added you will be able to configure your regions, zones and CSS files on the fly. There will also be a grid generator for you to easily build and integrate your own custom grids.') . '</div>';
  
  $form['info'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme information'),
  );
  
  $form['info']['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
    '#description' => t('The human-readable name for this theme.'),
    '#default_value' => isset($subtheme->info['name']) ? $subtheme->info['name'] : '',
    '#size' => 30,
    '#required' => TRUE,
  );
  
  $form['info']['description'] = array(
    '#type' => 'textarea',
    '#title' => t('Description'),
    '#description' => t('The description that will be shown on the theme listing page.'),
    '#default_value' => isset($subtheme->info['description']) ? $subtheme->info['description'] : '',
  );
  
  $form['info']['version'] = array(
    '#type' => 'textfield',
    '#title' => t('Version'),
    '#description' => t('The version of this theme.'),
    '#default_value' => isset($subtheme->info['version']) ? $subtheme->info['version'] : '1.x',
  );
  
  return $form;
}
/**
 * @todo
 */
function omega_tools_subtheme_wizard_info_form_submit($form, &$form_state) {
  $values = $form_state['values'];
  
  $subtheme = &$form_state['subtheme'];
  $subtheme->info['name'] = $values['name'];
  $subtheme->info['description'] = $values['description'];
  $subtheme->info['version'] = $values['version'];
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_grid_form($form, &$form_state) {
  $subtheme = $form_state['subtheme'];
  
  return $form;
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_structure_form($form, &$form_state) {
  $subtheme = $form_state['subtheme'];
  
  return $form;
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_settings_form($form, &$form_state) {
  $subtheme = $form_state['subtheme'];
  
  return $form;
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_finalize_form($form, &$form_state) {
  $subtheme = $form_state['subtheme'];
  
  $form['notice']['#markup'] = '<div class="messages warning">' . t('Step 2, 3 and 4 of this subtheme wizard are still in development and will be added shortly. Once they are added you will be able to configure your regions, zones and CSS files on the fly. There will also be a grid generator for you to easily build and integrate your own custom grids.') . '</div>';
  
  $form['finalize'] = array(
    '#type' => 'fieldset',
    '#title' => t('Finalize'),
  );
  
  $form['finalize']['description'] = array(
    '#type' => 'item',
    '#markup' => t('This is the final step for configuring your subtheme. You are now able to alter the final result by changing the <em>Advanced configuration</em>.'),
  );
  
  $form['finalize']['enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enabled'),
    '#description' => t('Decide wether or not this theme should be enabled.'),
    '#default_value' => $subtheme->status,
  );
  
  $form['finalize']['default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Default theme'),
    '#description' => t('Decide wether or not you want this theme to be your default theme.'),
    '#default_value' => $subtheme->default,
    '#states' => array(
      'visible' => array(
        ':input[name="enable"]' => array('checked' => TRUE),
      ),
    ),
  );
  
  $form['finalize']['advanced'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced configuration'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['finalize']['advanced']['manipulate'] = array(
    '#type' => 'checkbox',
    '#title' => t('Manipulate the content of %file', array('%file' => $subtheme->machine_name . '.info')),
    '#description' => t('After enabling this option you are able to edit the textarea below.'),
    '#default_value' => FALSE,
  );
  
  $form['finalize']['advanced']['info'] = array(
    '#type' => 'textarea',
    '#title' => t('Content of %file', array('%file' => $subtheme->machine_name . '.info')),
    '#description' => t('Only change the content of this textarea if you know what you are doing.'),
    '#default_value' => omega_tools_build_info_file($subtheme->info),
    '#rows' => 20,
    '#states' => array(
      'enabled' => array(
        ':input[name="manipulate"]' => array('checked' => TRUE),
      ),
    ),
  );
  
  return $form;
}

/**
 * @todo
 */
function omega_tools_subtheme_wizard_finalize_form_submit($form, &$form_state) {
  $values = $form_state['values'];
  $subtheme = &$form_state['subtheme'];  
  
  $subtheme->info = $values['manipulate'] ? drupal_parse_info_format($values['info']) : $subtheme->info;
  $subtheme->status = $values['enable'];
  $subtheme->default = $values['enable'] && $values['default'];
}