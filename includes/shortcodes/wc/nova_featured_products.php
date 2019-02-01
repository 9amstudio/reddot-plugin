<?php
add_shortcode( 'nova_featured_products', 'nova_featured_products' );
function nova_featured_products($atts){

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'category' 				=> '',
		'tax' 						=> 'product_cat',
		'limit' 					=> '12',
		'orderby'					=> 'title',
		'order'						=> 'ASC',
		'layout' 					=> 'grid',
		'columns'					=> 4,
		'enable_ajax_loader' 	=> '',
	), $atts));
	if(!empty($enable_ajax_loader)){
		return nova_shortcode_products_list_ajax($atts,'featured');
	}else {
		return nova_shortcode_products_list($atts,'featured');
	}
}
