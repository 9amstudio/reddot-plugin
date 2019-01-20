<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'nova_hero_image_editor_assets' ) ) {
  function nova_contact_stores_editor_assets() {
      wp_enqueue_script(
          'novaworks/contact-stores',
          plugins_url( 'build/index.js', __FILE__ ),
          array( 'wp-blocks', 'wp-element' )
      );
      wp_enqueue_style(
  		'novaworks/contact-stores-editor-style',
          plugins_url( 'assets/editor.css', __FILE__ ),
          array( 'wp-edit-blocks' )
  	);
  }
}
add_action( 'enqueue_block_editor_assets', 'nova_contact_stores_editor_assets');

if ( ! function_exists( 'nova_contact_stores_assets' ) ) {
  function nova_contact_stores_assets() {
      wp_enqueue_style(
  		'novaworks/contact-stores',
          plugins_url( 'assets/view.css', __FILE__ ),
          array( 'wp-blocks' )
  	);
  }
}
add_action( 'enqueue_block_assets', 'nova_contact_stores_assets');
