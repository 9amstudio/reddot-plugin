<?php
	/**
	 * Plugin Name: Reddot Plugin
	 * Plugin URI: https://reddot.nineamstudio.com/
	 * Description: The plugin for Reddot Woocommerce WordPress Theme
	 * Version: 1.0.0
	 * Author: 9AMstudio
	 * Author URI: https://nineamstudio.com
	 * Requires at least: 5.0
	 * Tested up to: 5.0
	 *
	 * @package  Reddot Plugin
	 * @author 9AMstudio
	 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$theme = wp_get_theme();
if ( $theme->template != 'reddot') {
	return;
}

include_once( 'includes/shortcodes/wp/socials.php' );
include_once( 'includes/shortcodes/wp/slider.php' );
include_once( 'includes/shortcodes/wp/blog-posts.php' );
include_once( 'includes/shortcodes/wp/custom-button.php' );
include_once( 'includes/shortcodes/wc/woocommerce_products_user_bought.php' );

/******************************************************************************/
/* Plugin Updater *************************************************************/
/******************************************************************************/

add_action( 'init', 'github_reddot_plugin_updater' );
if(!function_exists('github_reddot_plugin_updater')) {
	function github_reddot_plugin_updater() {

		include_once 'updater.php';

		define( 'WP_GITHUB_FORCE_UPDATE', true );

		if ( is_admin() ) {

			$config = array(
				'slug' 				 => plugin_basename(__FILE__),
				'proper_folder_name' => 'reddot-plugin',
				'api_url' 			 => 'https://api.github.com/repos/9amstudio/reddot-plugin',
				'raw_url' 			 => 'https://raw.github.com/9amstudio/reddot-plugin/master',
				'github_url' 		 => 'https://github.com/9amstudio/reddot-plugin',
				'zip_url' 			 => 'https://github.com/9amstudio/reddot-plugin/zipball/master',
				'sslverify'			 => true,
				'requires'			 => '5.0',
				'tested'			 => '5.0',
				'readme'			 => 'README.md',
				'access_token'		 => '',
			);

			new WP_GitHub_Updater( $config );
		}
	}
}

/******************************************************************************/
/* Add Shortcodes to VC *******************************************************/
/******************************************************************************/

if ( defined(  'WPB_VC_VERSION' ) ) {

	add_action( 'init', 'nova_visual_composer_shortcodes' );
	function nova_visual_composer_shortcodes() {

		// Add new WP shortcodes to VC

		include_once( 'includes/shortcodes/vc/wp/slider.php' );
		include_once( 'includes/shortcodes/vc/wp/blog-posts.php' );
		include_once( 'includes/shortcodes/vc/wp/custom-button.php' );

	}
}

/******************************************************************************/
/* Add Gutenberg Blocks *******************************************************/
/******************************************************************************/

add_action( 'init', 'nova_reddot_gutenberg_blocks' );
if(!function_exists('nova_reddot_gutenberg_blocks')) {
	function nova_reddot_gutenberg_blocks() {

		if( is_plugin_active( 'gutenberg/gutenberg.php' ) || is_wp_version('>=', '5.0') ) {
			include_once 'includes/nova-gutenberg-blocks/index.php';
		} else {
			add_action( 'admin_notices', 'nova_reddot_theme_warning' );
		}
	}
}

if( !function_exists('nova_reddot_theme_warning') ) {
	function nova_reddot_theme_warning() {

		?>

		<div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">
			<p>The Reddot Plugin couldn't find the Block Editor (Gutenberg) on this site. It requires WordPress 5+ or Gutenberg installed as a plugin.</p>
		</div>

		<?php
	}
}

if(!function_exists('is_wp_version')) {
	function is_wp_version( $operator = '>', $version = '4.0' ) {

		global $wp_version;

		return version_compare( $wp_version, $version, $operator );
	}
}
