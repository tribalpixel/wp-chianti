<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Add custom options for Wordpress Theme Customizer
 *
 * @author Tribalpixel
 * @package WP Chianti
 */
class WP_Chianti_Settings {

  /**
   * Define the colors scheme names for the theme customizer
   * 
   * @return array
   */
  public function getColors() {
    // Options for Color scheme based on production zone: Firenze, Siena, Arezzo, Pisa, Pistoia, Prato
    return [
        "arezzo" => __("Arezzo", 'wp-chianti'),
        "firenze" => __("Firenze", 'wp-chianti'),
        "prato" => __("Prato", 'wp-chianti'),
        "pisa" => __("Pisa", 'wp-chianti'),
        "pistoia" => __("Pistoia", 'wp-chianti'),
        "siena" => __("Siena", 'wp-chianti')
    ];
  }

  /**
   * Define the colors scheme 5 values for the theme
   * 
   * @return array
   * @TODO: find a way to get the same values for SCSS/CSS/JS, with no duplicate 
   */
  public function getColorsValues() {

    $arezzo = [
        'rgba(158, 158, 158, 1)',
        'rgba(130, 114, 101, 1)',
        'rgba(46, 0, 20, 1)',
        'rgba(68, 34, 32, 1)',
        'rgba(128, 152, 72, 1) '
    ];

    $firenze = [
        'rgba(68, 17, 81, 1)',
        'rgba(136, 54, 119, 1)',
        'rgba(202, 97, 195, 1)',
        'rgba(238, 133, 181, 1)',
        'rgba(255, 149, 140, 1)'
    ];

    $prato = [
        'rgba(7, 57, 7, 1)',
        'rgba(255, 255, 255, 1)',
        'rgba(249, 218, 124, 1)',
        'rgba(95, 2, 31, 1)',
        'rgba(255, 182, 193, 1)'
    ];

    $pisa = [
        'rgba(107, 45, 92, 1)',
        'rgba(240, 56, 107, 1)',
        'rgba(255, 83, 118, 1)',
        'rgba(248, 192, 200, 1)',
        'rgba(234, 234, 234, 1)'
    ];

    $pistoia = [
        'rgba(61, 64, 70, 1)',
        'rgba(120, 52, 85, 1)',
        'rgba(147, 81, 133, 1)',
        'rgba(192, 182, 205, 1)',
        'rgba(221, 229, 231, 1)'
    ];

    $siena = [
        'rgba(196, 68, 89, 1)',
        'rgba(196, 82, 133, 1)',
        'rgba(216, 42, 36, 1)',
        'rgba(173, 17, 43, 1)',
        'rgba(221, 242, 235, 1)',
    ];

    return [
        "arezzo" => $arezzo,
        "firenze" => $firenze,
        "prato" => $prato,
        "pisa" => $pisa,
        "pistoia" => $pistoia,
        "siena" => $siena
    ];
  }

}
