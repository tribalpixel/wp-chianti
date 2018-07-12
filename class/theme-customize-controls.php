<?php

if (!class_exists('WP_Customize_Control')) {
  return NULL;
}

/**
 * Custom Color Scheme Control
 */
class WP_Chianti_Color_Scheme_Control extends WP_Customize_Control {
  
  private $colors;

  public function __construct($manager, $id, $args = array(), $colors) {
    parent::__construct($manager, $id, $args);
    $this->colors = $colors;
  }
  
  /**
   * Render the content on the theme customizer page
   */
  protected function render_content() {
    $input_id = '_customize-input-' . $this->id;
    $description_id = '_customize-description-' . $this->id;
    $describedby_attr = (!empty($this->description) ) ? ' aria-describedby="' . esc_attr($description_id) . '" ' : '';
    $name = '_customize-radio-' . $this->id;
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
              foreach ($this->colors[$value] as $color) {
                $set .= '<span style="width:2em; height:2em; border:2px solid #FFF; background-color: ' . $color . '; display: inline-block;" title="' . $color . '">&nbsp;</span>';
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


/**
 * 
 */
class WP_Chianti_Fonts_Control extends WP_Customize_Control { 
  


}