<?php
//require_once trailingslashit( get_template_directory() ) .'vendor/autoload.php';

/**
 * Add custom options for Wordpress Theme Customizer
 *
 * @author Tribalpixel
 * @package WP Chianti
 */
class wp_chianti_theme_customize {

    public function __construct() {
        add_action('customize_register', array($this, 'register'));
    }

    public function register($wp_customize) {

        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        $wp_customize->remove_section('custom_css');

        // Add Section for theme options in customizer panel
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

        // Setting for color scheme based on production zone: Firenze, Siena, Arezzo, Pisa, Pistoia, Prato
        $colors_scheme = array("arezzo" => "Arezzo", "firenze" => "Firenze", "prato" => "Prato", "pisa" => "Pisa", "pistoia" => "Pistoia", "siena" => "Siena");
        $colors_set = array(
            "arezzo" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
            "firenze" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
            "prato" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
            "pisa" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014'),
            "siena" => array('#A30A28', '#D34360', '#C51A3C', '#87001A', '#640014')
        );
        $wp_customize->add_setting('wp_chianti_colors_scheme_option', array(
            'default' => 'firenze', // The default setting
                //'type' => 'theme_mod', // can use 'theme_mod' or 'option'
        ));

        // Add Control for Color Scheme

        $wp_customize->add_control(
                new Color_Scheme_Custom_Control(
                $wp_customize, 'wp_chianti_layout_option_control', array(
                    'label' => __('Color Scheme', 'wp-chianti'),
                    'description' => __('Color Scheme description here...', 'wp-chianti'),
                    'section' => 'wp_chianti_options_section',
                    'settings' => 'wp_chianti_colors_scheme_option'
                ))
        );


        /*
          $wp_customize->add_control('wp_chianti_colors_scheme_option_control', array(
          'label' => __('Color Scheme', 'wp-chianti'), // label for the control
          'description' => __('Color Scheme description here...', 'wp-chianti'), // description of the control
          'settings' => 'wp_chianti_colors_scheme_option', // the setting
          'section' => 'wp_chianti_options_section', // core ones are: 'title_tagline', 'colors', 'header_image', 'background_image', 'nav', 'static_front_page'
          'type' => 'radio', // core ones include: 'checkbox', 'radio', 'select', 'textarea', 'dropdown-pages', 'text'
          'choices' => array("arezzo" => "Arezzo", "firenze" => "Firenze", "prato" => "Prato", "pisa" => "Pisa", "pistoia" => "Pistoia", "siena" => "Siena"), // associative array of 'value' => 'option user sees'
          'priority' => 31, // the higher the number the lower it will appear from the top
          ));

         */
    }

}

if (!class_exists('WP_Customize_Control')) {
    return NULL;
}

/**
 * Class to create a custom control
 */
class Color_Scheme_Custom_Control extends WP_Customize_Control {

    public $colors_scheme;
    public $colors_set;

    /**
     * Render the content on the theme customizer page
     */
    public function render_content() {
//        $r = [];
//        foreach ($this->colors_scheme as $k => $v) {
//            $set = $v . '<div class="color-scheme">';
//            foreach ($this->colors_set[$k] as $value) {
//                $set .= '<span style="width:25px; height:25px; border:1px solid red;">' . $value . '</span>';
//            }
//            $set .= '</div>';
//            $r[$k] = $set;
//        }
        //echo $this->label;
        //echo $this->description;
        var_dump($this->section);
        ?>
        <label>
            <input type="radio" value="arezzo" name="_customize-radio-wp_chianti_colors_scheme_option_control" data-customize-setting-link="wp_chianti_colors_scheme_option">
            Arezzo<br>
        </label>
        <?php
    }

}
