<?php
if (!defined('ABSPATH')) die();

define('DIVI_CHILD_VERSION', '2.0.5');

// INFO: Setup

/**
 * STATIC: Load all scripts and styles
 */
function divi_child_enqueue_scripts() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

  divi_child_enqueue_assets_automatic(get_stylesheet_directory_uri() . '/assets/css/', 'css');
  divi_child_enqueue_assets_automatic(get_stylesheet_directory_uri() . '/assets/js/', 'js');




  /*wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style('divi-fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
  wp_enqueue_script( 'divi-scripts', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), null, true);*/
}
add_action( 'wp_enqueue_scripts', 'divi_child_enqueue_scripts' );

function divi_child_enqueue_assets_automatic ($dir_asset, $mode) {
  /*
    Dynamic: Load everything in $dir_asset in alphabetical order
  */
  $files = array();
  $dir = opendir($dir_asset);
  while(false != ($file = readdir($dir))) {
    if(($file != ".") and ($file != "..") and ($file != "index.php")) {
            $files[] = $file; // put in array.
    }
  }

  natsort($files); // sort.

  // print.
  foreach($files as $file) {
    if ($mode == "css") {
      wp_enqueue_style($file, $dir_asset . $file);
    }
    else if ($mode == "js") {
      wp_enqueue_script($file, $dir_asset . $file, array(), null, true);
    }
  }
}

/**
 * STATIC: Load all language files
 */
function divi_child_languages() {
  load_child_theme_textdomain('divi-child', get_stylesheet_directory() . '/languages');
}
add_action( 'after_setup_theme', 'divi_child_languages');


/**
 * STATIC: Custom Body Class for Child Theme
 */
function divi_child_body_class( $classes ) {
  $classes[] = 'child';
  return $classes;
}
add_action( 'body_class', 'divi_child_body_class' );


// Admin
include_once('admin/admin.php');

// Helpers
include_once('includes/helpers.php');

// GDPR
include_once('includes/child_gdpr.php');

// Bugfixes
include_once('includes/child_bugfixes.php');

// Pagespeed
include_once('includes/child_pagespeed.php');

// Miscellaneous
include_once('includes/child_misc.php');

/** -------- Add your own code after this! -------- **/

function divi_child_enqueue_custom_scripts() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style('divi-fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
  wp_enqueue_script( 'divi-scripts', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), null, true);
}
add_action( 'wp_enqueue_scripts', 'divi_child_enqueue_custom_scripts' );

?>
