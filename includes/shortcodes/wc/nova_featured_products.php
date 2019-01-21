<?php
add_shortcode( 'nova_featured_products', 'wcpscwc_featured_products_slider' );
function wcpscwc_featured_products_slider($atts){

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'cats' 				=> '',
		'design' 			=> '',
		'tax' 				=> 'product_cat',
		'limit' 			=> '-1',
		'slide_to_show' 	=> '3',
		'slide_to_scroll' 	=> '3',
		'autoplay' 			=> 'true',
		'autoplay_speed' 	=> '3000',
		'speed' 			=> '300',
		'arrows' 			=> 'true',
		'dots' 				=> 'true',
		'rtl'  				=> '',
		'slider_cls'		=> 'products',
	), $atts));

	$unique = uniqid('nova_products_');

	$cat = (!empty($cats)) ? explode(',',$cats) 	: '';
	$slider_cls = !empty($slider_cls) ? $slider_cls : 'products';
	$design = !empty($design) ? $design : '';

 	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	ob_start();

	// setup query
  $tax_query = array();
  $tax_query[] = array('relation' => 'AND');
  $tax_query[] =array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => 'featured',
        'operator' => 'IN',
      );
  // Category Parameter
  if($cat != "") {

    $tax_query[] =array(
                    'taxonomy' 	=> $tax,
                    'field' 	=> 'id',
                    'terms' 	=> $cat
              );
  }

  $args = array(
    'post_type'				=> 'product',
    'post_status' 			=> 'publish',
    'ignore_sticky_posts'	=> 1,
    'posts_per_page' 		=> $limit,
    'tax_query' 			=> $tax_query,
  );

	// query database
	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>
		<div class="wcpscwc-product-slider-wrap wcps-<?php echo $design; ?>">
			<div class="woocommerce wcpscwc-product-slider" id="wcpscwc-product-slider-<?php echo $unique; ?>">
			<?php
			woocommerce_product_loop_start();
			while ( $products->have_posts() ) : $products->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile; // end of the loop.
			woocommerce_product_loop_end(); ?>
			</div>
		</div>
	<?php endif;
	wp_reset_postdata();
	return ob_get_clean();
}
