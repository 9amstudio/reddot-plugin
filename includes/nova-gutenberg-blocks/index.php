<?php

//==============================================================================
//	Main Editor Styles
//==============================================================================
wp_enqueue_style(
	'nova-reddot-blocks-editor-styles',
	plugins_url( 'assets/css/editor.css', __FILE__ ),
	array( 'wp-edit-blocks' )
);

//==============================================================================
//	Main JS
//==============================================================================
add_action( 'admin_init', 'nova_reddot_blocks_scripts' );
if ( ! function_exists( 'nova_reddot_blocks_scripts' ) ) {
	function nova_reddot_blocks_scripts() {

		wp_enqueue_script(
			'nova-reddot-blocks-editor-scripts',
			plugins_url( 'assets/js/main.js', __FILE__ ),
			array( 'wp-blocks', 'jquery' )
		);

	}
}

include_once 'posts_grid/block.php';
include_once 'contact-stores/block.php';
//include_once 'slider/block.php';
