<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//==============================================================================
//  Enqueue Editor Assets
//==============================================================================
add_action( 'enqueue_block_editor_assets', 'nova_18_th_slider_editor_assets' );
if ( ! function_exists( 'nova_18_th_slider_editor_assets' ) ) {
	function nova_18_th_slider_editor_assets() {

		wp_enqueue_script(
			'nova_18_th_slide_script',
			plugins_url( 'blocks/slide.js', __FILE__ ),
			array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element' )
		);
		
		wp_enqueue_script(
			'nova_18_th_slider_script',
			plugins_url( 'blocks/slider.js', __FILE__ ),
			array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element' )
		);

		wp_enqueue_style(
			'nova_18_th_slider_editor_styles',
			plugins_url( 'assets/css/backend/editor.css', __FILE__ ),
			array( 'wp-edit-blocks' ),
			filemtime(plugin_dir_path(__FILE__) . 'assets/css/backend/editor.css')
		);
	}
}

//==============================================================================
//  Enqueue Frontend Assets
//==============================================================================
add_action( 'enqueue_block_assets', 'nova_18_th_slider_assets' );
if ( ! function_exists( 'nova_18_th_slider_assets' ) ) {
	function nova_18_th_slider_assets() {
		
		wp_enqueue_style(
			'nova_18_th_slider_styles',
			plugins_url( 'assets/css/frontend/style.css', __FILE__ ),
			array(),
			filemtime(plugin_dir_path(__FILE__) . 'assets/css/frontend/style.css')
		);
	}
}