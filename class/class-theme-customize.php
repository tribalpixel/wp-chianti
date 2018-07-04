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

  public function __construct() {
    add_action('customize_register', array($this, 'register'));
  }

  public function register($wp_customize) {

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->remove_section('custom_css');

    /**
     * LAYOUT/COLORS OPTIONS
     * ************************************************************************ */
    // Add Section for theme layout/colors
    $wp_customize->add_section('wp_chianti_options_section', array(
        'title' => __('WP Chianti Options', 'wp-chianti'),
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
        'section' => 'wp_chianti_options_section', // core ones are: 'title_tagline', 'colors', 'header_image', 'background_image', 'nav', 'static_front_page'
        'settings' => 'wp_chianti_layout_option', // the setting 
        'type' => 'select', // core ones include: 'checkbox', 'radio', 'select', 'textarea', 'dropdown-pages', 'text'
        'choices' => array(
            'classico' => __('Classico', 'wp-chianti'),
            'riserva' => __('Riserva', 'wp-chianti'),
        ), // associative array of 'value' => 'option user sees'
        'priority' => 30, // the higher the number the lower it will appear from the top
    ));

    // Options for Color scheme based on production zone: Firenze, Siena, Arezzo, Pisa, Pistoia, Prato
    $colors_scheme = array(
        "arezzo" => __("Arezzo", 'wp-chianti'),
        "firenze" => __("Firenze", 'wp-chianti'),
        "prato" => __("Prato", 'wp-chianti'),
        "pisa" => __("Pisa", 'wp-chianti'),
        "pistoia" => __("Pistoia", 'wp-chianti'),
        "siena" => __("Siena", 'wp-chianti')
    );

    // Setting for Color scheme
    $wp_customize->add_setting('wp_chianti_colors_scheme_option', array(
        'default' => 'prato'
    ));

    // Add Control for Color Scheme
    $wp_customize->add_control(new WP_Chianti_Color_Scheme_Control($wp_customize, 'wp_chianti_colors_scheme_option_control', array(
        'label' => __('Color Scheme', 'wp-chianti'),
        'description' => __('Color Scheme description here...', 'wp-chianti'),
        'settings' => 'wp_chianti_colors_scheme_option',
        'section' => 'wp_chianti_options_section',
        'type' => 'radio',
        'choices' => $colors_scheme,
        'priority' => 31,
    )));

    /**
     * SOCIAL OPTIONS
     * ************************************************************************ */
    // Add Section for theme Social Links
    $wp_customize->add_section('wp_chianti_social_settings', array(
        'title' => __('WP Chianti Social Settings', 'wp-chianti'),
        'description' => __('Leave blank if you do not want to show the social link.', 'wp-chianti'),
        'priority' => 2, // the higher the number the lower in the customizer from the top
    ));


    // Facebook
    $wp_customize->add_setting('wp_chianti_social_facebook', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_facebook', array(
        'label' => __('Facebook', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );

    // Twitter
    $wp_customize->add_setting(
            'wp_chianti_social_twitter', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_twitter', array(
        'label' => __('Twitter', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );

    // Google Plus
    $wp_customize->add_setting(
            'wp_chianti_social_google_plus', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_google_plus', array(
        'label' => __('Google Plus', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );

    // LinkedIn
    $wp_customize->add_setting(
            'wp_chianti_social_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_linkedin', array(
        'label' => __('LinkedIn', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );

    // Youtube
    $wp_customize->add_setting(
            'wp_chianti_social_youtube', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_youtube', array(
        'label' => __('YouTube', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );

    // Instagram
    $wp_customize->add_setting(
            'wp_chianti_social_instagram', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_instagram', array(
        'label' => __('Instagram', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );

    // Pinterest
    $wp_customize->add_setting(
            'wp_chianti_social_pinterest', array(
        'default' => '',
        'sanitize_callback' => 'wp_chianti_social_sanitize_url',
            )
    );

    $wp_customize->add_control(
            'wp_chianti_social_pinterest', array(
        'label' => __('Pinterest', 'wp-chianti'),
        'section' => 'wp_chianti_social_settings',
        'type' => 'text',
            )
    );



    // End register()  
  }

// End Class
}

if (!class_exists('WP_Customize_Control')) {
  return NULL;
}

/**
 * Class to create a custom control
 */
class WP_Chianti_Color_Scheme_Control extends WP_Customize_Control {

  /**
   * Render the content on the theme customizer page
   */
  public function render_content() {
    $input_id = '_customize-input-' . $this->id;
    $description_id = '_customize-description-' . $this->id;
    $describedby_attr = (!empty($this->description) ) ? ' aria-describedby="' . esc_attr($description_id) . '" ' : '';
    $name = '_customize-radio-' . $this->id;
    $colors_set = array(
        "arezzo" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
        "firenze" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
        "prato" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
        "pisa" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
        "pistoia" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
        "siena" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014')
    );
    ?>
    <?php if (!empty($this->label)) : ?>
      <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
    <?php endif; ?>
    <?php if (!empty($this->description)) : ?>
      <span id="<?php echo esc_attr($description_id); ?>" class="description customize-control-description"><?php echo $this->description; ?></span>
    <?php endif; ?>

    <?php foreach ($this->choices as $value => $label) : ?>
      <span class="customize-inside-control-row">
          <input
              id="<?php echo esc_attr($input_id . '-radio-' . $value); ?>"
              type="radio"
              <?php echo $describedby_attr; ?>
              value="<?php echo esc_attr($value); ?>"
              name="<?php echo esc_attr($name); ?>"
              <?php $this->link(); ?>
              <?php checked($this->value(), $value); ?>
              />
              <?php
              $set = '<div class="color-scheme">';
              foreach ($colors_set[$value] as $color) {
                $set .= '<span style="width:2em; height:2em; border:2px solid #FFF; background-color: ' . $color . '; display: inline-block;">&nbsp;</span>';
              }
              $set .= '</div>';
              ?>
          <label for="<?php echo esc_attr($input_id . '-radio-' . $value); ?>"><?php
              echo esc_html($label);
              echo $set;
              ?></label>
      </span>
    <?php endforeach; ?>
    <?php
  }

}
