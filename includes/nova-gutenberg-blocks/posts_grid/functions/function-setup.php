<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//==============================================================================
//	Enqueue Editor Assets
//==============================================================================
add_action( 'enqueue_block_editor_assets', 'nova_18_gutenberg_posts_grid_editor_assets' );
if ( ! function_exists( 'nova_18_gutenberg_posts_grid_editor_assets' ) ) {
	function nova_18_gutenberg_posts_grid_editor_assets() {

		wp_register_script(
			'nova_18_gutenberg_posts_grid_script',
			plugins_url( 'block.js', dirname(__FILE__) ),
			array( 'wp-api-request', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element' )
		);

		wp_register_style(
			'nova_18_gutenberg_posts_grid_editor_styles',
			plugins_url( 'assets/css/editor.css', dirname(__FILE__) ),
			array( 'wp-edit-blocks' ),
			filemtime(plugin_dir_path(__FILE__) . '../assets/css/editor.css')
		);
	}
}

//==============================================================================
//	Enqueue Frontend Assets
//==============================================================================
add_action( 'enqueue_block_assets', 'nova_18_gutenberg_posts_grid_assets' );
if ( ! function_exists( 'nova_18_gutenberg_posts_grid_assets' ) ) {
	function nova_18_gutenberg_posts_grid_assets() {

		wp_enqueue_style(
			'nova_18_gutenberg_posts_grid_styles',
			plugins_url( 'assets/css/style.css', dirname(__FILE__) ),
			array(),
			filemtime(plugin_dir_path(__FILE__) . '../assets/css/style.css')
		);
	}
}

//==============================================================================
//	Register Block Type
//==============================================================================
if ( function_exists( 'register_block_type' ) ) {
	register_block_type( 'nova/gb-posts-grid', array(
		'editor_style'  	=> 'nova_18_gutenberg_posts_grid_editor_styles',
		'editor_script'		=> 'nova_18_gutenberg_posts_grid_script',
		'attributes'      					=> array(
			'number'						=> array(
				'type'						=> 'number',
				'default'					=> '12',
			),
			'categoriesSavedIDs'			=> array(
				'type'						=> 'string',
				'default'					=> '',
			),
			'align'							=> array(
				'type'						=> 'string',
				'default'					=> 'center',
			),
			'orderby'						=> array(
				'type'						=> 'string',
				'default'					=> 'date_desc',
			),
			'columns'						=> array(
				'type'						=> 'number',
				'default'					=> '3'
			),
		),

		'render_callback' => 'nova_18_gutenberg_render_frontend_posts_grid',
	) );
}
