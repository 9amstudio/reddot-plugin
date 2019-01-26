<?php

// [nova_collection]
function nova_shortcode_collection($atts) {

	extract(shortcode_atts(array(
		"collection_id" 		=>  '',
		"img_pos" 		=>  'bottom',
		"label" 		=>  '',
		"title" 		=>  '',
		"sub_title" 		=>  '',
		"description" 		=>  '',
	), $atts));

	ob_start();
	?>
	<div class="nova-collection">
		<?php echo ($img_pos == 'top')? '<img src="'. wp_get_attachment_url($collection_id,'full').'" alt="" class="nova-collection__img">' : ''; ?>
		<div class="nova-collection__inner">
			<div class="nova-collection__label">
				<?php echo $label ?>
			</div>
			<h1 class="nova-collection__titlle"><?php echo $title ?></h1>
			<p class="nova-collection__subtitle">
				<?php echo $sub_title ?>
			</p>
			<p class="nova-collection__description">
				<?php echo $description ?>
			</p>
		</div>
		<?php echo ($img_pos == 'bottom')? '<img src="'. wp_get_attachment_url($collection_id,'full').'" alt="" class="nova-collection__img">' : ''; ?>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("nova_collection", "nova_shortcode_collection");
