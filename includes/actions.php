<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if( !function_exists('nova_ajax_render_shortcode')) {
  function nova_ajax_render_shortcode() {
      $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';
      if(!empty($data) ) {
          echo nova_shortcode_products_list($data);
      }
      die();
  }
}
add_action( 'wp_ajax_nova_get_shortcode_loader_by_ajax', 'nova_ajax_render_shortcode' );
add_action( 'wp_ajax_nopriv_nova_get_shortcode_loader_by_ajax', 'nova_ajax_render_shortcode' );
