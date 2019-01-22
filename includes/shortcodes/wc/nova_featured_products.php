<?php
add_shortcode( 'nova_featured_products', 'nova_featured_products' );
function nova_featured_products($atts){

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'category' 				=> '',
		'tax' 				=> 'product_cat',
		'limit' 			=> '-1',
	), $atts));
	$cat = (!empty($category)) ? explode(',',$category) 	: '';
	$carousel_configs = nova_get_param_slider_shortcode( $atts );

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
                    'field' 	=> 'slug',
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
		<div class="nova-product-shortcodes woocommerce">
			<ul class="products slick-carousel" <?php echo $carousel_configs ?>>
				<?php
				//woocommerce_product_loop_start();
				while ( $products->have_posts() ) : $products->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile; // end of the loop.
				//woocommerce_product_loop_end(); ?>
			</ul>
		</div>
	<?php endif;
	wp_reset_postdata();
	return ob_get_clean();
}
