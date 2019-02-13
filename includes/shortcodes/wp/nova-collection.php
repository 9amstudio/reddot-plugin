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
		"collection_link" => ''
	), $atts));

	$collection_link = ( '||' === $collection_link ) ? '' : $collection_link;
	$collection_link = nova_build_link_from_atts( $collection_link );
	$link_start = $link_end = '';
	if ( strlen( $collection_link['url'] ) > 0 ) {
		$link_start = '<a href="'.$collection_link['url'].'" class="nova-collection__link" target="'.$collection_link['target'].'">';
		$link_end = '<div class="nova-collection__icon"><i class="reddot-icons-arrow-right"></i><svg class="svg-icon"><use xlink:href="#reddot-arrow-right"></use></svg></div></a>';
	}

	ob_start();
	?>
	<div class="nova-collection">
		<?php echo ($img_pos == 'top')? $link_start.'<img src="'. wp_get_attachment_url($collection_id,'full').'" alt="" class="nova-collection__img">'.$link_end : ''; ?>
		<div class="nova-collection__inner">
			<div class="nova-collection__label">
				<?php echo $label ?>
			</div>
			<h1 class="nova-collection__title"><?php echo $title ?></h1>
			<p class="nova-collection__subtitle">
				<?php echo $sub_title ?>
			</p>
			<p class="nova-collection__description">
				<?php echo $description ?>
			</p>
		</div>
		<?php echo ($img_pos == 'bottom')? $link_start.'<img src="'. wp_get_attachment_url($collection_id,'full').'" alt="" class="nova-collection__img">'.$link_end : ''; ?>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("nova_collection", "nova_shortcode_collection");
