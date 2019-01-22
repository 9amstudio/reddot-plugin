<?php
if( !function_exists('nova_build_link_from_atts')) {
    function nova_build_link_from_atts($value){
        $result = array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' );
        $params_pairs = explode( '|', $value );
        if ( ! empty( $params_pairs ) ) {
            foreach ( $params_pairs as $pair ) {
                $param = preg_split( '/\:/', $pair );
                if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
                    $result[ $param[0] ] = rawurldecode( $param[1] );
                }
            }
        }
        return $result;
    }
}
if( !function_exists('nova_get_param_slider_shortcode')) {
  function nova_get_param_slider_shortcode( $atts, $param_column = 'columns' ){
      $slider_type    = $slide_to_scroll = $speed = $infinite_loop = $autoplay = $autoplay_speed = '';
      $lazyload       = $arrows = $dots = $dots_icon = $next_icon = $prev_icon = $dots_color = $draggable = $touch_move = '';
      $rtl            = $arrow_color = $arrow_size = $el_class = '';
      $slides_column = $autowidth = $css_ad_carousel = $pauseohover = $centermode = $adaptive_height = '';

      extract( shortcode_atts( array(
          'slider_type' => 'horizontal',
          'slide_to_scroll' => 'all',
          'slides_column' => '',
          'infinite_loop' => '',
          'speed' => '300',
          'autoplay' => '',
          'autoplay_speed' => '5000',
          'arrows' => '',
          'next_icon' => 'dlicon-arrow-right1',
          'prev_icon' => 'dlicon-arrow-left1',
          'custom_nav' => '',
          'dots' => '',
          'dots_color' => '#333333',
          'dots_icon' => 'dlicon-dot7',
          'draggable' => 'yes',
          'touch_move' => 'yes',
          'rtl' => '',
          'adaptive_height' => '',
          'pauseohover' => '',
          'centermode' => '',
          'autowidth' => '',
          'item_space' => '15',
          'el_class' => '',
          'css_ad_carousel' => ''
      ), $atts ) );

      if(isset($atts[$param_column])){
          $slides_column = $atts[$param_column];
      }

      $slides_column = nova_get_column_from_param_shortcode($slides_column);

      $custom_dots = $arr_style = $wrap_data = '';


      if ( $slide_to_scroll == 'all' ) {
          $slide_to_scroll = $slides_column['xlg'];
      } else {
          $slide_to_scroll = 1;
      }

      $setting_obj = array();
      $setting_obj['slidesToShow'] = absint($slides_column['xlg']);
      $setting_obj['slidesToScroll'] = absint($slide_to_scroll);

      if ( $dots == 'yes' ) {
          $setting_obj['dots'] = true;
      } else {
          $setting_obj['dots'] = false;
      }
      if ( $autoplay == 'yes' ) {
          $setting_obj['autoplay'] = true;
      }
      if ( $autoplay_speed !== '' ) {
          $setting_obj['autoplaySpeed'] = absint($autoplay_speed);
      }
      if ( $speed !== '' ) {
          $setting_obj['speed'] = absint($speed);
      }
      if ( $infinite_loop == 'yes' ) {
          $setting_obj['infinite'] = true;
      } else {
          $setting_obj['infinite'] = false;
      }
      if ( $lazyload == 'yes' ) {
          $setting_obj['lazyLoad'] = true;
      }

      if ( is_rtl() ) {
          $setting_obj['rtl'] = true;
          if ( $arrows == 'yes' ) {
              $setting_obj['arrows'] = true;
          } else {
              $setting_obj['false'] = false;
          }
      } else {
          if ( $arrows == 'yes' ) {
              $setting_obj['arrows'] = true;
          } else {
              $setting_obj['arrows'] = false;
          }
      }

      if ( $draggable == 'yes' ) {
          $setting_obj['swipe'] = true;
          $setting_obj['draggable'] = true;
      } else {
          $setting_obj['swipe'] = false;
          $setting_obj['draggable'] = false;
      }

      if ( $touch_move == 'yes' ) {
          $setting_obj['touchMove'] = true;
      } else {
          $setting_obj['touchMove'] = false;
      }

      if ( $rtl == 'yes' ) {
          $setting_obj['rtl'] = true;
      }

      if ( $slider_type == 'vertical' ) {
          $setting_obj['vertical'] = true;
      }

      if ( $pauseohover == 'yes' ) {
          $setting_obj['pauseOnHover'] = true;
      } else {
          $setting_obj['pauseOnHover'] = false;
      }

      if ( $centermode == 'yes' ) {
          $setting_obj['centerMode'] = true;
          $setting_obj['centerPadding'] = '12%';
      }

      if ( $autowidth == 'yes' ) {
          $setting_obj['variableWidth'] = true;
          $wrap_data .= ' aria-autowidth="true"';
      }

      if ( $adaptive_height == 'yes' ) {
          $setting_obj['adaptiveHeight'] = true;
      }

      $setting_obj['responsive'] = array(
          array(
              'breakpoint' => 1824,
              'settings' => array(
                  'slidesToShow' => $slides_column['lg'],
                  'slidesToScroll' => $slides_column['lg']
              )
          ),
          array(
              'breakpoint' => 1200,
              'settings' => array(
                  'slidesToShow' => $slides_column['md'],
                  'slidesToScroll' => $slides_column['md']
              )
          ),
          array(
              'breakpoint' => 992,
              'settings' => array(
                  'slidesToShow' => $slides_column['sm'],
                  'slidesToScroll' => $slides_column['sm']
              )
          ),
          array(
              'breakpoint' => 768,
              'settings' => array(
                  'slidesToShow' => $slides_column['xs'],
                  'slidesToScroll' => $slides_column['xs']
              )
          ),
          array(
              'breakpoint' => 480,
              'settings' => array(
                  'slidesToShow' => $slides_column['mb'],
                  'slidesToScroll' => $slides_column['mb']
              )
          )
      );

      $setting_obj['pauseOnDotsHover'] = true;

      $wrap_data .= "data-slick='". esc_attr(wp_json_encode($setting_obj)) ."'";

      return $wrap_data;
  }
}
if( !function_exists('nova_get_column_from_param_shortcode')) {
  function nova_get_column_from_param_shortcode( $atts ){
      $array = array(
          'xlg'	=> 3,
          'lg' 	=> 3,
          'md' 	=> 2,
          'sm' 	=> 1,
          'xs' 	=> 1,
          'mb' 	=> 1
      );
      $atts = explode(';',$atts);
      if(!empty($atts)){
          foreach($atts as $val){
              $val = explode(':',$val);
              if(isset($val[0]) && isset($val[1])){
                  if(isset($array[$val[0]])){
                      $array[$val[0]] = absint($val[1]);
                  }
              }
          }
      }
      return $array;
  }
}
if( !function_exists('nova_field_column')) {
  function nova_field_column($options = array()){
      return array_merge(array(
          'type' 			=> 'nova_column',
          'heading' 		=> __('Column', 'reddot'),
          'param_name' 	=> 'column',
          'unit'			=> '',
          'media'			=> array(
              'xlg'	=> 1,
              'lg'	=> 1,
              'md'	=> 1,
              'sm'	=> 1,
              'xs'	=> 1,
              'mb'	=> 1
          )
      ), $options);
  }
}
