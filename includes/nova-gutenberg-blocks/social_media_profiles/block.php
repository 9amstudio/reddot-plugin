<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//==============================================================================
//  Enqueue Editor Assets
//==============================================================================
add_action( 'enqueue_block_editor_assets', 'nova_18_th_social_media_editor_assets' );
if ( ! function_exists( 'nova_18_th_social_media_editor_assets' ) ) {
    function nova_18_th_social_media_editor_assets() {
        
        wp_register_script(
            'nova_18_th_social_media_script',
            plugins_url( 'block.js', __FILE__ ),
            array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element' )
        );

        wp_register_style(
            'nova_18_th_social_media_editor_styles',
            plugins_url( 'assets/css/editor.css', __FILE__ ),
            array( 'wp-edit-blocks' ),
            filemtime(plugin_dir_path(__FILE__) . 'assets/css/editor.css')
        );
    }
}

//==============================================================================
//  Enqueue Frontend Assets
//==============================================================================
add_action( 'enqueue_block_assets', 'nova_18_th_social_media_assets' );
if ( ! function_exists( 'nova_18_th_social_media_assets' ) ) {
    function nova_18_th_social_media_assets() {
        
        wp_enqueue_style(
            'nova_18_th_social_media_styles',
            plugins_url( 'assets/css/style.css', __FILE__ ),
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'assets/css/style.css')
        );
    }
}

//==============================================================================
//  Register Block Type
//==============================================================================
if ( function_exists( 'register_block_type' ) ) {
    register_block_type( 'nova/th-social-media-profiles', array(
        'editor_style'      => 'nova_18_th_social_media_editor_styles',
        'editor_script'     => 'nova_18_th_social_media_script',
    	'attributes'     			=> array(
    		'align'			        => array(
    			'type'				=> 'string',
    			'default'			=> 'left',
    		),
            'fontSize'              => array(
                'type'              => 'number',
                'default'           => '16',
            ),
            'fontColor'             => array(
                'type'              => 'string',
                'default'           => '#000',
            ),
    	),

    	'render_callback' => 'nova_18_th_social_media_frontend_output',
    ) );
}

//==============================================================================
//  Frontend Output
//==============================================================================
if ( ! function_exists( 'nova_18_th_social_media_frontend_output' ) ) {
    function nova_18_th_social_media_frontend_output($attributes) {

    	extract(shortcode_atts(
    		array(
    			'align'       => 'left',
                'fontSize'    => '16',
                'fontColor'   => '#000',
    		), $attributes));
        ob_start();

        ?>

        <div class="nova_18_th_social_media_profiles">
            <?php echo do_shortcode('[socials align="'.$align.'" fontsize="'.$fontSize.'" fontcolor="'.$fontColor.'"]'); ?>
        </div>

    	<?php 
        return ob_get_clean();
    }
}