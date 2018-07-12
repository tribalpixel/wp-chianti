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
class WP_Chianti_Theme_Customize {
  
  private $theme_settings;

  public function __construct() {
    $this->theme_settings = new WP_Chianti_Settings();
    add_action('customize_register', array($this, 'register'));
    add_action('customize_preview_init', array($this, 'customize_preview_js'));
    add_action('customize_controls_enqueue_scripts', array($this, 'customize_styles'));
  }

  /**
   * Custom CSS for Theme Customizer
   */
  public function customize_styles() {
    wp_enqueue_style('admin-theme-css', get_template_directory_uri() . '/css/admin-theme.css', false, CHIANTI_THEME_VERSION, false);
  }

  /**
   * Bind JS handlers to instantly live-preview changes.
   */
  public function customize_preview_js() {
    wp_enqueue_script('customize-preview', get_theme_file_uri('/js/customize-preview.js'), array('customize-preview'), '1.0', true);
  }

  /**
   * Render the site title for the selective refresh partial.
   * @return void
   */
  public function customize_partial_blogname() {
    bloginfo('name');
  }

  /**
   * Render the site tagline for the selective refresh partial.
   * @return void
   */
  public function customize_partial_blogdescription() {
    bloginfo('description');
  }

  /**
   * Sanitize URL for social links
   * @param string $string
   * @return string
   */
  public function social_sanitize_url($string) {
    return esc_url(trim($string), array('http', 'https'));
  }

  /**
   * Render the theme options for WP Customizer
   * @param object $wp_customize
   */
  public function register($wp_customize) {

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->remove_section('custom_css');

    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector' => '.site-title a',
        'render_callback' => array($this, 'customize_partial_blogname'),
    ));
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => array($this, 'customize_partial_blogdescription'),
    ));

    /**
     * LAYOUT/COLORS OPTIONS
     * ************************************************************************ */
    // Add Section for theme layout/colors
    $wp_customize->add_section('wp_chianti_layout_section', array(
        'title' => __('WP Chianti Layout Settings', 'wp-chianti'),
        'description' => __('', 'wp-chianti'),
        'priority' => 1, // the higher the number the lower in the customizer from the top
    ));

    // Setting for Layout: Classico / Riserva
    $wp_customize->add_setting('wp_chianti_layout_option', array(
        'default' => 'classico', // The default setting
            //'type' => 'theme_mod', // can use 'theme_mod' or 'option'
    ));

    // Add Control for Layout
    $wp_customize->add_control('wp_chianti_layout_option_control', array(
        'label' => __('Layout', 'wp-chianti'), // label for the control
        'description' => __('Layout description here...', 'wp-chianti'), // description of the control
        'section' => 'wp_chianti_layout_section', // core ones are: 'title_tagline', 'colors', 'header_image', 'background_image', 'nav', 'static_front_page'
        'settings' => 'wp_chianti_layout_option', // the setting 
        'type' => 'select', // core ones include: 'checkbox', 'radio', 'select', 'textarea', 'dropdown-pages', 'text'
        'choices' => array(
            'classico' => __('Classico', 'wp-chianti'),
            'riserva' => __('Riserva', 'wp-chianti'),
        ), // associative array of 'value' => 'option user sees'
        'priority' => 30, // the higher the number the lower it will appear from the top
    ));


    // Setting for Color scheme
    $wp_customize->add_setting('wp_chianti_colors_scheme_option', array(
        'default' => 'prato',
        'transport' => 'postMessage',
    ));

    // Add Control for Color Scheme
    $wp_customize->add_control(new WP_Chianti_Color_Scheme_Control($wp_customize, 'wp_chianti_colors_scheme_option_control', array(
        'label' => __('Color Scheme', 'wp-chianti'),
        'description' => __('Color Scheme description here...', 'wp-chianti'),
        'settings' => 'wp_chianti_colors_scheme_option',
        'section' => 'wp_chianti_layout_section',
        'type' => 'radio',
        'choices' => $this->theme_settings->getColors(),
        'priority' => 31,
    ), $this->theme_settings->getColorsValues()));
    /*
      // Add Fonts Options
      $wp_customize->add_setting('wp_chianti_fonts_option', array(
      'default' => 'opensans',
      'transport' => 'postMessage',
      ));
      $wp_customize->add_control(new WP_Chianti_Fonts_Control($wp_customize, 'wp_chianti_fonts_option_control', array(
      'label' => __('Fonts', 'wp-chianti'),
      'description' => __('Fonts description here...', 'wp-chianti'),
      'settings' => 'wp_chianti_fonts_option',
      'section' => 'wp_chianti_layout_section',
      'type' => 'select',
      'choices' => [
      'lato' => 'Lato',
      'opensans' => 'Open Sans'
      ],
      'priority' => 29,
      )));
     */
    /**
     * SOCIAL OPTIONS
     * ************************************************************************ */
    // Add Section for theme Social Links
    $wp_customize->add_section('wp_chianti_social_section', array(
        'title' => __('WP Chianti Social Settings', 'wp-chianti'),
        'description' => __('Leave blank if you do not want to show the social link.', 'wp-chianti'),
        'description_hidden' => false,
        'priority' => 2, // the higher the number the lower in the customizer from the top
    ));


    // Facebook
    $wp_customize->add_setting('wp_chianti_social_facebook', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_facebook', array(
        'label' => __('Facebook', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // Twitter
    $wp_customize->add_setting('wp_chianti_social_twitter', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_twitter', array(
        'label' => __('Twitter', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // Google Plus
    $wp_customize->add_setting('wp_chianti_social_google_plus', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_google_plus', array(
        'label' => __('Google Plus', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // LinkedIn
    $wp_customize->add_setting('wp_chianti_social_linkedin', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_linkedin', array(
        'label' => __('LinkedIn', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // Youtube
    $wp_customize->add_setting('wp_chianti_social_youtube', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_youtube', array(
        'label' => __('YouTube', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // Instagram
    $wp_customize->add_setting('wp_chianti_social_instagram', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_instagram', array(
        'label' => __('Instagram', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // Pinterest
    $wp_customize->add_setting('wp_chianti_social_pinterest', array(
        'default' => '',
        'sanitize_callback' => array($this, 'social_sanitize_url')
    ));
    $wp_customize->add_control('wp_chianti_social_pinterest', array(
        'label' => __('Pinterest', 'wp-chianti'),
        'section' => 'wp_chianti_social_section',
        'type' => 'text',
    ));

    // End register()  
  }

// End Class
}
