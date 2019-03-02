<?php

/*
**	Instagram Feed
*/

$shortcode_params = array(
  array(
    'heading'     => esc_html__( 'Instagram Access Token', 'reddot-plugin' ),
    'description' => esc_html__( 'In order to display your photos you need an Access Token from Instagram.', 'reddot-plugin' ),
    'type'        => 'textfield',
    'param_name'  => 'instagram_token',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Feed Type', 'reddot-plugin' ),
    'type'        => 'dropdown',
    'param_name'  => 'feed_type',
    'value'       => array(
      esc_html__( 'Images with a specific tag', 'reddot-plugin' ) => 'tagged',
      esc_html__( 'Images from a location.', 'reddot-plugin' ) => 'location',
      esc_html__( 'Images from a user', 'reddot-plugin' ) => 'user',
    ),
    'admin_label' => true,
    'std'         => 'user',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Hashtag', 'reddot-plugin' ),
    'description' => esc_html__( 'Only Alphanumeric characters are allowed (a-z, A-Z, 0-9)', 'reddot-plugin' ),
    'type'        => 'textfield',
    'param_name'  => 'hashtag',
    'admin_label' => true,
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Location ID', 'reddot-plugin' ),
    'description' => esc_html__( 'Unique id of a location to get', 'reddot-plugin' ),
    'type'        => 'textfield',
    'param_name'  => 'location_id',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'User ID', 'reddot-plugin' ),
    'description' => esc_html__( 'Unique id of a user to get', 'reddot-plugin' ),
    'type'        => 'textfield',
    'param_name'  => 'user_id',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Sort By', 'reddot-plugin' ),
    'type'        => 'dropdown',
    'param_name'  => 'sort_by',
    'admin_label' => true,
    'value'       => array(
      esc_html__( 'Default', 'reddot-plugin' ) => 'none',
      esc_html__( 'Newest to oldest', 'reddot-plugin' ) => 'most-recent',
      esc_html__( 'Oldest to newest', 'reddot-plugin' ) => 'least-recent',
      esc_html__( 'Highest # of likes to lowest.', 'reddot-plugin' ) => 'most-liked',
      esc_html__( 'Lowest # likes to highest.', 'reddot-plugin' ) => 'least-liked',
      esc_html__( 'Highest # of comments to lowest', 'reddot-plugin' ) => 'most-commented',
      esc_html__( 'Lowest # of comments to highest.', 'reddot-plugin' ) => 'least-commented',
      esc_html__( 'Random order', 'reddot-plugin' ) => 'random',
    ),
    'std'         => 'none',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
      'type' => 'dropdown',
      'heading' => esc_html__('Layout','reddot-plugin'),
      'param_name' => 'layout',
      'value' => array(
          esc_html__('Grid','reddot-plugin') => 'grid',
          esc_html__('Slider','reddot-plugin') => 'slider'
      ),
      'std' => 'grid',
      'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),
  array(
      'type' => 'dropdown',
      'heading' => esc_html__('Columns','reddot-plugin'),
      'param_name' => 'column',
      'value' => array(
          esc_html__('2 Columns','reddot-plugin') => '2',
          esc_html__('3 Columns','reddot-plugin') => '3',
          esc_html__('4 Columns','reddot-plugin') => '4',
          esc_html__('5 Columns','reddot-plugin') => '5',
          esc_html__('6 Columns','reddot-plugin') => '6'
      ),
      'std' => '5',
      'group' 		=> esc_html__('Layout Setting', 'reddot-plugin'),
      'dependency' => array(
          'element' => 'layout',
          'value' => 'grid'
      )
  ),
  array(
    'heading'     => esc_html__( 'Limit', 'reddot-plugin' ),
    'description' => esc_html__( 'Maximum number of Images to add. Max of 60', 'reddot-plugin' ),
    'type'        => 'textfield',
    'param_name'  => 'limit',
    'admin_label' => true,
    'value'       => 5,
    'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),
  array(
    'heading'     => esc_html__( 'Image size', 'reddot-plugin' ),
    'type'        => 'dropdown',
    'param_name'  => 'image_size',
    'value'       => array(
      esc_html__( 'Thumbnail', 'reddot-plugin' ) => 'thumbnail',
      esc_html__( 'Low Resolution', 'nova' ) => 'low_resolution',
      esc_html__( 'Standard Resolution', 'reddot-plugin' ) => 'standard_resolution'
    ),
    'std'         => 'thumbnail',
    'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),
  array(
    'heading'     => esc_html__( 'Image Aspect Ration', 'reddot-plugin' ),
    'type'        => 'dropdown',
    'param_name'  => 'image_aspect_ration',
    'value'       => array(
      esc_html__( '1:1', 'reddot-plugin' ) => '11',
      esc_html__( '16:9', 'reddot-plugin' ) => '169',
      esc_html__( '4:3', 'reddot-plugin' ) => '43',
      esc_html__( '2.35:1', 'reddot-plugin' ) => '2351'
    ),
    'std'         => '11',
    'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),

);
$carousel = nova_vc_slider_params();
$shortcode_params = array_merge( $shortcode_params, $carousel);
vc_map(array(

   "name"			=> "Instagram Feed",
   "category"		=> "9AMstudio",
   "description"	=> esc_html__( 'Display Instagram photos from any non-private Instagram accounts', 'reddot-plugin' ),
   "base"			=> "instagram_feed",
   "class"			=> "",
   "icon"			=> get_template_directory_uri() . "/assets/images/vc/instagram.png",
   "params" 		=> $shortcode_params

));
