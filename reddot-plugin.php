<?php
	/**
	 * Plugin Name: Reddot Plugin
	 * Plugin URI: https://reddot.nineamstudio.com/
	 * Description: The plugin for Reddot Woocommerce WordPress Theme
	 * Author: 9AMstudio
	 * Author URI: https://nineamstudio.com
	 * Version:          1.0.0
	 * License:           GNU General Public License v2
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
	 * Domain Path:       /languages
	 * Text Domain:       reddot-plugin
	 * Network:           true
	 * GitHub Plugin URI: hhttps://github.com/9amstudio/reddot-plugin
	 * Requires WP:       4.6
	 * Requires PHP:      5.6
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
include_once( 'includes/helpers.php' );
include_once( 'includes/actions.php' );

// Meta Boxes
include_once( 'includes/metaboxes/page.php' );


/******************************************************************************/
/* Include shortcode  *********************************************************/
/******************************************************************************/

add_action( 'init', 'nova_include_shortcodes' );
if(!function_exists('nova_include_shortcodes')) {
	function nova_include_shortcodes() {
		include_once( 'includes/shortcodes/wp/socials.php' );
		include_once( 'includes/shortcodes/wp/slider.php' );
		include_once( 'includes/shortcodes/wp/nova-banner.php' );
		include_once( 'includes/shortcodes/wp/nova-heading.php' );
		include_once( 'includes/shortcodes/wp/nova-spacer.php' );
		include_once( 'includes/shortcodes/wp/blog-posts.php' );
		include_once( 'includes/shortcodes/wp/custom-button.php' );
		include_once( 'includes/shortcodes/wp/nova-collection.php' );
		include_once( 'includes/shortcodes/wp/instagram.php' );
		if(class_exists( 'WooCommerce' )){
			include_once( 'includes/shortcodes/wc/woocommerce_products_user_bought.php' );
			include_once( 'includes/shortcodes/wc/nova_featured_products.php' );
			include_once( 'includes/shortcodes/wc/nova_recent_products.php' );
			include_once( 'includes/shortcodes/wc/nova_best_selling_products.php' );
		}
	}
}

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
	include_once( 'class/nova-vc-init.php' );
	include_once( 'class/nova-vc-shortcode-param.php' );
	include_once( 'class/nova-vc-autocomplete-filters.php' );
	include_once( 'includes/vc-params.php' );
	add_action( 'init', 'nova_visual_composer_shortcodes' );


	if(!function_exists('nova_visual_composer_shortcodes')) {
		function nova_visual_composer_shortcodes() {

			// Add new WP shortcodes to VC

			include_once( 'includes/shortcodes/vc/wp/slider.php' );
			include_once( 'includes/shortcodes/vc/wp/nova-banner.php' );
			include_once( 'includes/shortcodes/vc/wp/nova-heading.php' );
			include_once( 'includes/shortcodes/vc/wp/nova-spacer.php' );
			include_once( 'includes/shortcodes/vc/wp/blog-posts.php' );
			include_once( 'includes/shortcodes/vc/wp/custom-button.php' );
			include_once( 'includes/shortcodes/vc/wp/nova-collection.php' );
			include_once( 'includes/shortcodes/vc/wp/instagram.php' );
			if(class_exists( 'WooCommerce' )){
				include_once( 'includes/shortcodes/vc/wc/nova_featured_products.php' );
				include_once( 'includes/shortcodes/vc/wc/nova_recent_products.php' );
				include_once( 'includes/shortcodes/vc/wc/nova_best_selling_products.php' );
			}

			Nova_Shortcodes_Param::get_instance();
			Nova_Shortcodes_Autocomplete_Filters::get_instance();
		}
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
