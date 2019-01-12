<?php

// [slider]

function nova_slider($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'full_height' 		  	   	=> 'no',
		'custom_desktop_height' 	=> '800px',
		'custom_mobile_height' 	  	=> '600px',
		'slide_numbers'		  		=> 'false',
		'slide_numbers_color' 		=> '#000',
		'slide_style' => 'horizontal'
	), $params));

	if ( $full_height == 'no' && ( !empty($custom_desktop_height) || !empty($custom_mobile_height) ) ) {
		$extra_class = '';
	} else {
		$extra_class = 'full_height';
	}

	if ($full_height == 'no' && !empty($custom_desktop_height)) {
		$desktop_height = 'height:'.$custom_desktop_height.';';
	} else {
		$desktop_height = '';
	}

	if ($full_height == 'no' && !empty($custom_mobile_height)) {
		$mobile_height = '@media all and (max-width: 768px){.shortcode_nova_slider{ height:'.$custom_mobile_height.'!important;}}';
	} else {
		$mobile_height = '';
	}

	if($slide_style == 'horizontal'){
	$nova_slider_images = '
		<div class="slider__image swiper-container">
			<div class="swiper-wrapper">
				<!-- Image 1 -->
				<div class="swiper-slide">
					<div class="cover-slider" data-bg="assets/img/image_slider_1.jpg"><a class="swiper-slide__link" href="#"></a></div>
				</div>
				<!-- /Image 1 -->

				<!-- Image 2 -->
				<div class="swiper-slide">
					<div class="cover-slider" data-bg="assets/img/image_slider_1.jpg"><a class="swiper-slide__link" href="#"></a></div>
				</div>
				<!-- /Image 2 -->

				<!-- Image 3 -->
				<div class="swiper-slide">
					<div class="cover-slider" data-bg="assets/img/image_slider_1.jpg"><a class="swiper-slide__link" href="#"></a></div>
				</div>
				<!-- /Image 3 -->
			</div>
		</div>
		';
	} else {
		$nova_slider_images = '';
	}

	$nova_slider = '

		<div class="shortcode_nova_slider slider slider-'.$slide_style.' '.$extra_class.'" style="'.$desktop_height.' width: 100%">
			<div class="slider__caption swiper-container">
				<div class="swiper-wrapper">
				'.do_shortcode($content).'
				</div>
			</div>
			'.$nova_slider_images;

    if ($slide_numbers):
    	$nova_slider .= '<div class="quickview-pagination shortcode-slider-pagination" style="color: ' . $slide_numbers_color . '"></div>';
    endif;

	$nova_slider .=	'</div>';

	$nova_slider .= '<style>'.$mobile_height.' .swiper-pagination-bullet-active:after{ background-color: '.$slide_numbers_color.' } </style>';

	return $nova_slider;
}

add_shortcode('slider', 'nova_slider');

function nova_image_slide($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' 					=> '',
		'subtitle'				=> '',
		'description' 				=> '',
		'text_color'				=> '#000000',
		'button_text' 				=> '',
		'button_url'				=> '',
		'bg_color'					=> '#CCCCCC',
		'bg_image'					=> ''

	), $params));

	if (!empty($title))
	{
		$title = '<h1 class="slide-title title title--display-1 js-text-wave" style="color:'.$text_color.';">'.$title.'</h1>';
	} else {
		$title = "";
	}

	if (!empty($subtitle))
		{
			$subtitle = '<h6 class="slide-title title title--overhead"><span class="down-up"><span>'.$subtitle.'</span></span></h6>';
		} else {
			$subtitle = "";
	}

	if (is_numeric($bg_image))
	{
		$bg_image = wp_get_attachment_url($bg_image);
	} else {
		$bg_image = "";
	}
	$GLOBALS['slide_image'][] = $bg_image;

	if (!empty($description))
	{
		$description = '<p class="slide-description description" style="color:rgb('.nova_hex2rgb($text_color).');"><span class="down-up"><span>'.$description.'</span></span></p>';
	} else {
		$description = "";
	}

	if (!empty($button_text))
	{
		$button = '<a class="slide-button btn-link btn-link--circle-right" style="background-color:rgb('.nova_hex2rgb($text_color).'); border-color:rgb('.nova_hex2rgb($text_color).'); color:rgb('.nova_hex2rgb($text_color).');" href="'.$button_url.'"><span class="down-up"><span>'.$button_text.'<i class="circle circle--right icon-right-open"></i></span></span></a>';
	} else {
		$button = "";
	}

	$nova_image_slide = '

		<div class="swiper-slide"	style="background: '.$bg_color.';
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				color: '.$text_color.'">
			<div class="slider__item" data-swiper-parallax="-1000">
				'.$subtitle.'
				'.$title.'
				'.$description.'
				'.$button.'
			</div>
		</div>';

	return $nova_image_slide;
}

add_shortcode('image_slide', 'nova_image_slide');
