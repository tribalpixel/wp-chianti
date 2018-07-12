<?php

if (!defined('CHIANTI_THEME_VERSION')) {
  $theme = wp_get_theme();
  define('CHIANTI_THEME_VERSION', $theme->Version);
}

// *************************************************************************** //
// THEME SETTINGS PAGE
// *************************************************************************** //
require_once( trailingslashit(get_template_directory()) . 'vendor/autoload.php' );
require_once( trailingslashit(get_template_directory()) . 'class/theme-settings.php' );
//$theme_settings = new WP_Chianti_Settings();
require_once( trailingslashit(get_template_directory()) . 'class/theme-customize.php' );
require_once( trailingslashit(get_template_directory()) . 'class/theme-customize-controls.php' );
new WP_Chianti_Theme_Customize();

// *************************************************************************** //
// THEME SETUP
// *************************************************************************** //
// Set content width value based on the theme's design
if (!isset($content_width)) {
  $content_width = 960;
}

if (!function_exists('wp_chianti_theme_features')) {

  function wp_chianti_theme_features() {

    // Add theme support for Featured Images
    add_theme_support('post-thumbnails');

    // Add theme support for HTML5 Semantic Markup
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Add theme support for document Title tag
    add_theme_support('title-tag');

    // Add theme support for custom CSS in the TinyMCE visual editor
    add_editor_style();

    // Add theme support for Automatic Feed Links
    add_theme_support('automatic-feed-links');

    // Add theme support for Translation
    load_theme_textdomain('wp-chianti', get_template_directory() . '/language');

    // Add theme support for Custom Logo.
    add_theme_support('custom-logo', array('width' => 250, 'height' => 250, 'flex-width' => true));
  }

  add_action('after_setup_theme', 'wp_chianti_theme_features');
}

// *************************************************************************** //
// NAVIGATION MENUS
// *************************************************************************** //
function wp_chianti_navigation_menus() {

  $locations = array(
      'nav-header' => __('Main Navigation', 'wp-chianti'),
      'nav-content' => __('Secondary Navigation', 'wp-chianti'),
      'nav-footer' => __('Footer Navigation', 'wp-chianti'),
  );
  register_nav_menus($locations);
}

add_action('init', 'wp_chianti_navigation_menus');

// *************************************************************************** //
// SIDEBARS
// *************************************************************************** //
function wp_chianti_register_sidebars() {

  register_sidebar(array(
      'id' => 'sidebar-primary',
      'name' => __('Sidebar primary', 'wp-chianti'),
  ));

  register_sidebar(array(
      'id' => 'sidebar-secondary',
      'name' => __('Sidebar Secondary', 'wp-chianti'),
  ));
}

add_action('widgets_init', 'wp_chianti_register_sidebars');

// *************************************************************************** //
// REGISTER CSS/JS/EXTRA SCRIPTS
// *************************************************************************** //
function wp_chianti_register_scripts() {

  // CSS
  wp_enqueue_style('theme-css', get_template_directory_uri() . '/css/theme.css', false, CHIANTI_THEME_VERSION, false);
  wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.1.0/css/all.css', false, CHIANTI_THEME_VERSION, false);
  
  // Javascripts
  wp_enqueue_script('theme-nav-js', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), CHIANTI_THEME_VERSION, true);
  wp_enqueue_script('theme-main-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), CHIANTI_THEME_VERSION, true);
}

add_action('wp_enqueue_scripts', 'wp_chianti_register_scripts');

// *************************************************************************** //
// FILTERS
// *************************************************************************** //
function wp_chianti_title_separator($sep) {
  $sep = "|";
  return $sep;
}

add_filter('document_title_separator', 'wp_chianti_title_separator');

// Remove file editor in wordpress admin
define('DISALLOW_FILE_EDIT', true);
