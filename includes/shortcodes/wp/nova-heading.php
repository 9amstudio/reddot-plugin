<?php

// [nova_heading]
function nova_shortcode_heading($atts) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" 		=>  '',
		"sub_title" 		=>  '',
	), $atts));
	ob_start();
	?>
	<div class="nova-header-shortcode">
		<div class="nova-header-shortcode__inner">
			<h1><?php echo $title ?></h1>
			<p>
				<?php echo $sub_title ?>
			</p>
		</div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("nova_heading", "nova_shortcode_heading");
