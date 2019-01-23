<?php

// [slider]

function nova_slider( $params = array(), $content = null ) {
	extract( shortcode_atts( array(
		'full_height' 		  	  => 'no',
		'custom_desktop_height' => '800px',
		'custom_mobile_height' 	=> '600px',
		'slide_numbers'		  		=> false,
		'slide_numbers_color' 	=> '#000',
		'slide_style'           => 'horizontal'
	), $params));

	$GLOBALS['slider_count'] = 0;
	$GLOBALS['slide_style']  = $slide_style;

	if ( $full_height == 'no' && ( ! empty( $custom_desktop_height ) || ! empty( $custom_mobile_height ) ) ) {
		$extra_class = '';
	} else {
		$extra_class = 'full_height';
	}

	if ( $full_height == 'no' && ! empty( $custom_desktop_height ) ) {
		$desktop_height = 'height:' . $custom_desktop_height . ';';
	} else {
		$desktop_height = '';
	}

	if ( $full_height == 'no' && ! empty( $custom_mobile_height ) ) {
		$mobile_height = '@media all and (max-width: 768px){.shortcode_nova_slider{ height:' . $custom_mobile_height . '!important;}}';
	} else {
		$mobile_height = '';
	}

	global $slide_image_data;
	$slide_image_data = array();

	$nova_slider = '
		<div class="shortcode_nova_slider slider-' . $slide_style . ' ' . $extra_class . '" style="' . $desktop_height . ' width: 100%">
			<div class="slider__caption swiper-container">
				<div class="swiper-wrapper">
				' . do_shortcode( $content ) . '
				</div>
			</div>';

			if ( $slide_style == 'horizontal' ) {

				$nova_slider .= '
				<div class="slider__image swiper-container">
					<div class="swiper-wrapper">';

					foreach( $slide_image_data as $image_datas => $image_data ) {

						if ( ! empty( $image_data['button_text'] ) ) {
							$button = '<a class="slide-button" style="--slide-button-color:rgb(' . nova_hex2rgb( $image_data['button_color'] ) . ');" href="' . $image_data['button_url'] . '"><span class="down-up"><span>' . $image_data['button_text'] . '<svg class="svg-icon"><use xlink:href="#reddot-arrow-right"></use></svg></span></span></a>';
						} else {
							$button = "";
						}

						$nova_slider .= '
						<div class="swiper-slide">
							<div class="cover-slider" data-bg="' . $image_data['slide_image'] . '">' . $button . '</div>
						</div>
						';
					}

				$nova_slider .= '
					</div>
				</div>
				';
			}

    if ( $slide_numbers ):
    	$nova_slider .= '<div class="quickview-pagination shortcode-slider-pagination" style="color: ' . $slide_numbers_color . '"></div>';
    endif;

	$nova_slider .=	'</div>';

	$nova_slider .= '<style>' . $mobile_height . ' .swiper-pagination-bullet-active:after{ background-color: ' . $slide_numbers_color . ' } </style>';

	return $nova_slider;
}

add_shortcode( 'slider', 'nova_slider' );

function nova_image_slide( $params = array(), $content = null ) {
	extract( shortcode_atts( array(
		'title'        => '',
		'subtitle'     => '',
		'description'  => '',
		'text_color'   => '#000000',
		'button_text'  => '',
		'button_color' => '#232323',
		'button_url'   => '',
		'bg_color'     => '#ffffff',
		'bg_image'     => ''

	), $params) );

	if ( !empty( $title ) )	{
		$title = '<h1 class="slide-title"><span class="down-up"><span>' . $title . '</span></span></h1>';
	} else {
		$title = "";
	}

	if ( ! empty( $subtitle ) )	{
		$subtitle = '<h6 class="slide-subtitle"><span class="down-up"><span>' . $subtitle . '</span></span></h6>';
	} else {
		$subtitle = "";
	}

	if ( is_numeric( $bg_image ) ) {
		$bg_image = wp_get_attachment_url( $bg_image );
	} else {
		$bg_image = "";
	}

	//Add data to array
	global $slide_image_data;
	array_push( $slide_image_data, array( 'slide_image' => $bg_image, 'button_text' => $button_text, 'button_color' => $button_color, 'button_url' => $button_url ) );

	if ( !empty( $description ) ) {
		$description = '<p class="slide-description"><span class="down-up"><span>' . $description . '</span></span></p>';
	} else {
		$description = "";
	}

	if ( ! empty( $button_text ) ) {
		$button = '';
	} else {
		$button = "";
	}

	$nova_image_slide = '
		<div class="swiper-slide"	style="background: '.$bg_color.';">
			<div class="slider__item" data-swiper-parallax="-1000">
				'.$subtitle.'
				'.$title.'
				'.$description.'
				'.$button.'
			</div>
		</div>
		';

	return $nova_image_slide;
}

add_shortcode('image_slide', 'nova_image_slide');
