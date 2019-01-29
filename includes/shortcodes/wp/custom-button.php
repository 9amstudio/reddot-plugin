<?php

// [nova_custom_link]

function nova_shortcode_link($atts, $content = null) {

	extract(shortcode_atts(array(
		"title" => "",
        "color" => "",
        "url"   => ""
	), $atts));

    ob_start();
    ?>

    <a class="shortcode_nova nova_custom_link" href="<?php echo esc_html($url); ?>" style="color: <?php echo esc_html($color); ?>; border-color: <?php echo esc_html($color); ?>;"><?php printf(__( '%s', 'reddot' ), $title); ?></a>

    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("nova_custom_link", "nova_shortcode_link");
