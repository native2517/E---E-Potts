<?php
// $Id: template.php,v 1.2 2010/06/30 20:23:04 nomonstersinme Exp $

/**
 * Implementation of hook_theme().
 *
 * @return
 */
function orange_theme() {
  return array(
    // Custom theme functions.
    'forum_icon' => array(
      'arguments' => array('new_posts' => NULL, 'num_posts' => NULL, 'comment_mode' => NULL, 'sticky' => NULL),
    ),
    'breadcrumb' => array(
      'arguments' => array('breadcrumb' => array()),
    ),
    'fieldset' => array(),
    'id_safe' => array(
      'arguments' => array('string'),
      ),
    'conditional_stylesheets' => array(),
    'render_attributes' => array(
      'arguments' => array('attributes'),
    )
  );
}

/**
  * Implementation of theme_breadcrumb()
  * @see theme_breadcrumb(), orange_theme();
  *
  * Changed breadcrumb separator to an image and add current page's title to end
  */
function orange_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    $breadcrumb[] = drupal_get_title();
    $separator = theme('image', drupal_get_path('theme', 'orange') .'/images/black-bullet.gif');
    return '<div class="breadcrumb">'. implode(' '. $separator .' ', $breadcrumb) .'</div>';
  }
}
/**
 * Override, use better icons, source: http://drupal.org/node/102743#comment-664157
 *
 * Format the icon for each individual topic.
 *
 * @ingroup themeable
 */
function orange_forum_icon($new_posts, $num_posts = 0, $comment_mode = 0, $sticky = 0) {
  // because we are using a theme() instead of copying the forum-icon.tpl.php into the theme
  // we need to add in the logic that is in preprocess_forum_icon() since this isn't available
  if ($num_posts > variable_get('forum_hot_topic', 15)) {
    $icon = $new_posts ? 'hot-new' : 'hot';
  }
  else {
    $icon = $new_posts ? 'new' : 'default';
  }

  if ($comment_mode == COMMENT_NODE_READ_ONLY || $comment_mode == COMMENT_NODE_DISABLED) {
    $icon = 'closed';
  }

  if ($sticky == 1) {
    $icon = 'sticky';
  }

  $output = theme('image', path_to_theme() . "/images/forum-$icon.png");

  if ($new_posts) {
    $output = "<a name=\"new\">$output</a>";
  }

  return $output;
}

/**
  * Implementation of theme_fieldset
  *
  * @see theme_fieldset(), orange_theme(), orange.js
  *
  * Removed drupal js and label and created a title div
  */
function orange_fieldset($element) {
  if (!empty($element['#collapsible'])) {

    if (!isset($element['#attributes']['class'])) {
      $element['#attributes']['class'] = '';
    }

    $element['#attributes']['class'] .= ' collapsible';
    if (!empty($element['#collapsed'])) {
      $element['#attributes']['class'] .= ' collapsed';
    }
  }

  return '<fieldset'. drupal_attributes($element['#attributes']) .'>'. ($element['#title'] ? '<div class="fieldset-title">'. $element['#title'] .'</div>' : '') .'<div class="fieldset-body">'. (isset($element['#description']) && $element['#description'] ? '<div class="description">'. $element['#description'] .'</div>' : '') . (!empty($element['#children']) ? $element['#children'] : '') . (isset($element['#value']) ? $element['#value'] : '') ."</div> </fieldset>\n";
}
/**
  * Implementation of theme_block
  *
  * @see theme_block()
  *
  * Added first and last class to all blocks for styling.
  */
function orange_blocks($region) {
  $output = '';

  if ($list = block_list($region)) {
    $counter = 1; 
    foreach ($list as $key => $block) {
      
      $block->firstlast = '';
      if ($counter == 1){
        $block->firstlast .= ' first'; 
      }
      if ($counter == count($list)){
        $block->firstlast .= ' last';
      }
      $output .= theme('block', $block);
      $counter++;
    }
    //$block->count = count($list);
  }

  $output .= drupal_get_content($region);

  return $output;
}

/**
 * CSS Filter
 * Borrowed from Studio
 */
function orange_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = drupal_strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}

/**
 * Conditional Stylesheets
 * Loads alternate stylesheets for Internet Explorer
 */
function orange_conditional_stylesheets() {
  // Targets IE 6 and under
  $output = "\n".'<!--[if lt IE 7.0]><link rel="stylesheet" href="'. base_path() . path_to_theme() .'/css/ie-6.css" type="text/css" media="all" charset="utf-8" /><![endif]-->'."\n";
  // Targets IE 7
  $output .= '<!--[if IE 7.0]><link rel="stylesheet" href="'. base_path() . path_to_theme() .'/css/ie-7.css" type="text/css" media="all" charset="utf-8" /><![endif]-->'."\n";
  return $output;
  $output .= '<meta equiv="X-UA-Compatible" content="IE=8">';
}

/**
 * Create a string of attributes form a provided array.
 * Borrowed from Studio, http://drupal.org/project/studio
 *
 * @param $attributes
 * @return string
 */
function orange_render_attributes($attributes) {
  if ($attributes) {
    $items = array();
    foreach ($attributes as $attribute => $data) {
      if (is_array($data)) {
        $data = implode(' ', $data);
     	}
      if (is_string($data)) {
        $items[] = $attribute .'="'. $data .'"';
     	}
    }    
    $output = ' '. str_replace('_', '-', implode(' ', $items));
  }
  return $output;
}

/**
 * Implementation of hook_preprocess()
 * 
 * This function checks to see if a hook has a preprocess file associated with 
 * it, and if so, loads it.
 * 
 * @param $vars
 * @param $hook
 * @return Array
 */
function orange_preprocess(&$vars, $hook) {
  if(is_file(drupal_get_path('theme', 'orange') . '/preprocess/preprocess-' . str_replace('_', '-', $hook) . '.inc')) {
    include('preprocess/preprocess-' . str_replace('_', '-', $hook) . '.inc');
  }
}