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
              'heading'    => esc_html__( 'Slider Type', 'reddot' ),
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
              'heading'    => esc_html__( 'Slides to Scroll', 'reddot' ),
              'param_name' => 'slide_to_scroll',
              'value'      => array(
                  esc_html__('All visible', 'reddot') => 'all',
                  esc_html__('One at a Time', 'reddot') => 'single'
              ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          nova_field_column(array(
              'heading' 		=> esc_html__('Items to Show', 'reddot'),
              'param_name' 	=> 'slides_column',
              'group'      => $general_name,
              'dependency' => $dependency
          )),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Infinite loop', 'reddot'),
              'description'	=> esc_html__( 'Restart the slider automatically as it passes the last slide.', 'reddot' ),
              'param_name' 	=> 'infinite_loop',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'group'      => $general_name,
              'dependency' => $dependency

          ),
          array(
              'type'        => 'nova_number',
              'heading'     => esc_html__( 'Transition speed', 'reddot' ),
              'param_name'  => 'speed',
              'value'       => '300',
              'min'         => '100',
              'max'         => '10000',
              'step'        => '100',
              'suffix'      => 'ms',
              'description' => esc_html__( 'Speed at which next slide comes.', 'reddot' ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Autoplay Slides', 'reddot'),
              'param_name' 	=> 'autoplay',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'group'      => $general_name,
              'dependency' => $dependency
          ),
          array(
              'type'       => 'nova_number',
              'heading'    => esc_html__( 'Autoplay Speed', 'reddot' ),
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
              'heading' 		=> esc_html__('Navigation Arrows', 'reddot'),
              'description' 	=> esc_html__( 'Display next / previous navigation arrows', 'reddot' ),
              'param_name' 	=> 'arrows',
              'value' 		=> array(
                  esc_html__('Show', 'reddot') => 'yes'
              ),
              'group'      	=> 'Navigation',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Dots Navigation', 'reddot'),
              'description' 	=> esc_html__( 'Display dot navigation', 'reddot' ),
              'param_name' 	=> 'dots',
              'value' 		=> array(
                  esc_html__('Show', 'reddot') => 'yes'
              ),
              'group'      	=> 'Navigation',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Draggable Effect', 'reddot'),
              'description' 	=> esc_html__( 'Allow slides to be draggable', 'reddot' ),
              'param_name' 	=> 'draggable',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'std'           => 'yes',
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Touch Move', 'reddot'),
              'description' 	=> esc_html__( 'Enable slide moving with touch', 'reddot' ),
              'param_name' 	=> 'touch_move',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'std'           => 'yes',
              'dependency'  => array(
                  'element' => 'draggable', 'value' => array( 'yes' )
              ),
              'group'      	=> 'Advanced'
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('RTL Mode', 'reddot'),
              'description' 	=> esc_html__( 'Turn on RTL mode', 'reddot' ),
              'param_name' 	=> 'rtl',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Adaptive Height', 'reddot'),
              'description' 	=> esc_html__('Turn on Adaptive Height', 'reddot' ),
              'param_name' 	=> 'adaptive_height',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Pause on hover', 'reddot'),
              'description' 	=> esc_html__('Pause the slider on hover', 'reddot' ),
              'param_name' 	=> 'pauseohover',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'dependency'  => array(
                  'element' => 'autoplay', 'value' => array( 'yes' )
              ),
              'group'      	=> 'Advanced'
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Center mode', 'reddot'),
              'description' 	=> wp_kses_post(__("Enables centered view with partial prev/next slides. <br>Animations do not work with center mode.<br>Slides to scroll -> 'All Visible' do not work with center mode.", 'reddot')),
              'param_name' 	=> 'centermode',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          ),
          array(
              'type' 			=> 'checkbox',
              'heading' 		=> esc_html__('Item Auto Width', 'reddot'),
              'description' 	=> esc_html__('Variable width slides', 'reddot' ),
              'param_name' 	=> 'autowidth',
              'value' 		=> array(
                  esc_html__('Yes', 'reddot') => 'yes'
              ),
              'group'      	=> 'Advanced',
              'dependency' => $dependency
          )
      );
      return $params;
  }
}
