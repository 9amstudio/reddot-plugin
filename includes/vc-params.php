<?php
if( !function_exists('nova_vc_slider_params')) {
  function nova_vc_slider_params(){
      $general_name = esc_html__('Slider Setting', 'reddot');
      $dependency =  array(
          'element' => 'layout',
          'value' => 'slider'
      );
      $params = array(
          array(
              'type'       => 'dropdown',
              'heading'    => __( 'Slider Type', 'reddot' ),
              'param_name' => 'slider_type',
              'value'      => array(
                  esc_html__('Horizontal', 'reddot')            => 'horizontal',
                  esc_html__('Vertical', 'reddot')              => 'vertical'
              ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          array(
              'type'       => 'dropdown',
              'heading'    => __( 'Slides to Scroll', 'reddot' ),
              'param_name' => 'slide_to_scroll',
              'value'      => array(
                  esc_html__('All visible', 'reddot') => 'all',
                  esc_html__('One at a Time', 'reddot') => 'single'
              ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          nova_field_column(array(
              'heading' 		=> __('Items to Show', 'reddot'),
              'param_name' 	=> 'slides_column',
              'group'      => $general_name,
              'dependency' => $dependency
          )),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Infinite loop', 'reddot'),
              'description'	=> __( 'Restart the slider automatically as it passes the last slide.', 'reddot' ),
              'param_name' 	=> 'infinite_loop',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'group'      => $general_name,
              'dependency' => $dependency

          ),
          array(
              'type'        => 'nova_number',
              'heading'     => __( 'Transition speed', 'reddot' ),
              'param_name'  => 'speed',
              'value'       => '300',
              'min'         => '100',
              'max'         => '10000',
              'step'        => '100',
              'suffix'      => 'ms',
              'description' => __( 'Speed at which next slide comes.', 'reddot' ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Autoplay Slides', 'reddot'),
              'param_name' 	=> 'autoplay',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          array(
              'type'       => 'nova_number',
              'heading'    => __( 'Autoplay Speed', 'reddot' ),
              'param_name' => 'autoplay_speed',
              'value'      => '5000',
              'min'        => '100',
              'max'        => '10000',
              'step'       => '10',
              'suffix'     => 'ms',
              'dependency' => array(
                  'element' => 'autoplay', 'value' => 'yes'
              ),
              'group'      => $general_name
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Navigation Arrows', 'reddot'),
              'description' 	=> __( 'Display next / previous navigation arrows', 'reddot' ),
              'param_name' 	=> 'arrows',
              'value' 		=> array(
                  __('Show', 'reddot') => 'yes'
              ),
              'group'      	=> 'Navigation',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Dots Navigation', 'reddot'),
              'description' 	=> __( 'Display dot navigation', 'reddot' ),
              'param_name' 	=> 'dots',
              'value' 		=> array(
                  __('Show', 'reddot') => 'yes'
              ),
              'group'      	=> 'Navigation',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Draggable Effect', 'reddot'),
              'description' 	=> __( 'Allow slides to be draggable', 'reddot' ),
              'param_name' 	=> 'draggable',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'std'           => 'yes',
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Touch Move', 'reddot'),
              'description' 	=> __( 'Enable slide moving with touch', 'reddot' ),
              'param_name' 	=> 'touch_move',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'std'           => 'yes',
              'dependency'  => array(
                  'element' => 'draggable', 'value' => array( 'yes' )
              ),
              'group'      	=> 'Advanced'
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('RTL Mode', 'reddot'),
              'description' 	=> __( 'Turn on RTL mode', 'reddot' ),
              'param_name' 	=> 'rtl',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Adaptive Height', 'reddot'),
              'description' 	=> __('Turn on Adaptive Height', 'reddot' ),
              'param_name' 	=> 'adaptive_height',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Pause on hover', 'reddot'),
              'description' 	=> __('Pause the slider on hover', 'reddot' ),
              'param_name' 	=> 'pauseohover',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'dependency'  => array(
                  'element' => 'autoplay', 'value' => array( 'yes' )
              ),
              'group'      	=> 'Advanced'
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Center mode', 'reddot'),
              'description' 	=> __("Enables centered view with partial prev/next slides. <br>Animations do not work with center mode.<br>Slides to scroll -> 'All Visible' do not work with center mode.", 'reddot'),
              'param_name' 	=> 'centermode',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> __('Item Auto Width', 'reddot'),
              'description' 	=> __('Variable width slides', 'reddot' ),
              'param_name' 	=> 'autowidth',
              'value' 		=> array(
                  __('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          )
      );
      return $params;
  }
}
