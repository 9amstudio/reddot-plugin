<?php

// [instagram_feed]
function nova_shortcode_instagram_feed($atts) {

  extract(shortcode_atts(array(
    'instagram_token'     => '',
    'feed_type'           => 'user',
    'hashtag'             => '',
    'location_id'         => '',
    'user_id'             => '',
    'sort_by'             => 'none',
    'column'              => 5,
    'item_space'          => 'default',
    'enable_carousel'     => '',
    'limit'               => 5,
    'image_size'          => 'thumbnail',
    'image_aspect_ration' => '11',
    'el_class'            => '',

  ), $atts));

  $unique_id = uniqid( 'nova_instagram_feed_' );
  $carousel_configs = nova_get_param_slider_shortcode( $atts, 'column' );

  ob_start();

  ?>

  <div class="nova-instagram-feeds" id="<?php echo esc_attr( $unique_id ) ?>" data-feed_config='<?php echo esc_attr( wp_json_encode( array(
		'get' => $feed_type,
		'tagName' => $hashtag,
		'locationId' => $location_id,
		'userId' => $user_id,
		'sortBy' => $sort_by,
		'limit' => $limit,
		'resolution' => $image_size,
		'template' => '<li class="instagram-feed"><div class="instagram-item"><a target="_blank" href="{{link}}" title="{{caption}}" style="background-image: url({{image}});" class="thumbnail"><span class="item--overlay"><i class="fa fa-instagram"></i></span></a><div class="instagram-info"><span class="instagram-like"><i class="fa-heart"></i>{{likes}}</span><span class="instagram-comments"><i class="fa-comments"></i>{{comments}}</span></div></div></li>'
	) ) ) ?>' data-instagram_token="<?php echo esc_attr( $instagram_token ) ?>">
  <?php if ($enable_carousel):?>
    <ul class="instagram-feeds slick-carousel" <?php echo $carousel_configs ?>>
  <?php else:?>
    <ul class="instagram-feeds columns-<?php echo $column ?>">
  <?php endif ?>
    </ul>
  </div>

  <?php
  $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("instagram_feed", "nova_shortcode_instagram_feed");
