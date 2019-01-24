<?php

// [nova_heading]
function nova_shortcode_spacer($atts) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"height" 		=>  '',
	), $atts));
	ob_start();
	$unique_id = uniqid('nova_spacer');
	?>
	<div id="<?php echo esc_attr($unique_id)?>" class="nova-spacer-shortce js_responsive_css"<?php
	if(!empty($height)){
	    $default_style = nova_get_column_from_param_shortcode($height);
	    echo nova_get_responsive_media_css(array(
	        'target'		=> "#{$unique_id}",
	        'media_sizes' 	=> array(
	            'padding-top' 	=> $height,
	        )
	    ));
	    nova_render_ressponive_media_css($nova_fix_css, array(
	        'target'		=> "#{$unique_id}",
	        'media_sizes' 	=> array(
	            'padding-top' 	=> $height,
	        )
	    ));
	}
	?>>
</div>
	<?php nova_render_responsive_media_style_tags($nova_fix_css); ?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("nova_spacer", "nova_shortcode_spacer");
