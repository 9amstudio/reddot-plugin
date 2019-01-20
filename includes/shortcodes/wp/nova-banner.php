<?php

// [nova_banner]
function nova_shortcode_banner($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"banner_id" 		=>  '',
		"text_color" 		=>  '',
		"bg_overlay" 		=>  '',
		"bg_overlay_hover" 		=>  '',
		"banner_link" 		=>  '',
	), $atts));
	ob_start();
	//banner id
	$unique_id = uniqid('nova_banner_');
	//parse link
	$banner_link = ( '||' === $banner_link ) ? '' : $banner_link;
	$banner_link = nova_build_link_from_atts( $banner_link );

	$banner_button = '';
	if ( strlen( $banner_link['url'] ) > 0 ) {
	    $use_link = true;
	    $a_href = $banner_link['url'];
	    $a_title = $banner_link['title'];
	    $a_target = $banner_link['target'];
			$banner_button = '<a href="'.$a_href.'" class="button bordered nova-banner__button" target="'.$a_target.'">'.$a_title.'</a>';
	}
	?>
	<figure id="<?php echo esc_attr($unique_id)?>" class="nova-banner">
		<div class="nova-banner__overlay"></div>
		<img src="<?php echo wp_get_attachment_url($banner_id,'full'); ?>" alt="" class="nova-banner__img">
		<figcaption class="nova-banner__content">
			<div class="nova-banner__content-wrap">
				<?php echo wpb_js_remove_wpautop($content, true) ?>
				<?php echo $banner_button ?>
			</div>
	</figure>
	<?php if(!empty($bg_overlay) || !empty($bg_overlay_hover) || !empty($text_color)): ?>
	<span class="custom-styles-css hide">
	#<?php echo esc_attr($unique_id)?> .item--overlay{
	    background-color: <?php echo esc_attr($bg_overlay); ?>;
	}
	#<?php echo esc_attr($unique_id);?>:hover .item--overlay{
	   background-color: <?php echo esc_attr($bg_overlay_hover); ?>;
	}
	#<?php echo esc_attr($unique_id)?> .nova-banner__content-wrap,
	#<?php echo esc_attr($unique_id)?> .nova-banner__content-wrap h1,
	#<?php echo esc_attr($unique_id)?> .nova-banner__content-wrap h2 {
			color: <?php echo esc_attr($text_color); ?>;
	}
	</span>
	<?php endif;?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("nova_banner", "nova_shortcode_banner");
