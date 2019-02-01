<?php
add_shortcode( 'nova_recent_products', 'nova_recent_products' );
function nova_recent_products($atts){

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'category' 						=> '',
		'tax' 								=> 'product_cat',
		'limit' 							=> '12',
		'orderby'							=> 'title',
		'order'								=> 'ASC',
		'layout' 							=> 'grid',
		'columns'							=> 4,
		'enable_ajax_loader' 	=> '',
	), $atts));
	if(!empty($enable_ajax_loader)){
		return nova_shortcode_products_list_ajax($atts,'recent');
	}else {
		return nova_shortcode_products_list($atts,'recent');
	}
}
