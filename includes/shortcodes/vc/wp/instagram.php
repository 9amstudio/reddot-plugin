<?php

/*
**	Instagram Feed
*/

$shortcode_params = array(
  array(
    'heading'     => esc_html__( 'Instagram Access Token', 'nova' ),
    'description' => esc_html__( 'In order to display your photos you need an Access Token from Instagram.', 'nova' ),
    'type'        => 'textfield',
    'param_name'  => 'instagram_token',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Feed Type', 'nova' ),
    'type'        => 'dropdown',
    'param_name'  => 'feed_type',
    'value'       => array(
      esc_html__( 'Images with a specific tag', 'nova' ) => 'tagged',
      esc_html__( 'Images from a location.', 'nova' ) => 'location',
      esc_html__( 'Images from a user', 'nova' ) => 'user',
    ),
    'admin_label' => true,
    'std'         => 'user',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Hashtag', 'nova' ),
    'description' => esc_html__( 'Only Alphanumeric characters are allowed (a-z, A-Z, 0-9)', 'nova' ),
    'type'        => 'textfield',
    'param_name'  => 'hashtag',
    'admin_label' => true,
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Location ID', 'nova' ),
    'description' => esc_html__( 'Unique id of a location to get', 'nova' ),
    'type'        => 'textfield',
    'param_name'  => 'location_id',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'User ID', 'nova' ),
    'description' => esc_html__( 'Unique id of a user to get', 'nova' ),
    'type'        => 'textfield',
    'param_name'  => 'user_id',
    'group' 		  => esc_html__( 'Data Setting', 'reddot-plugin' )
  ),
  array(
    'heading'     => esc_html__( 'Sort By', 'nova' ),
    'type'        => 'dropdown',
    'param_name'  => 'sort_by',
    'admin_label' => true,
    'value'       => array(
      esc_html__( 'Default', 'nova' ) => 'none',
      esc_html__( 'Newest to oldest', 'nova' ) => 'most-recent',
      esc_html__( 'Oldest to newest', 'nova' ) => 'least-recent',
      esc_html__( 'Highest # of likes to lowest.', 'nova' ) => 'most-liked',
      esc_html__( 'Lowest # likes to highest.', 'nova' ) => 'least-liked',
      esc_html__( 'Highest # of comments to lowest', 'nova' ) => 'most-commented',
      esc_html__( 'Lowest # of comments to highest.', 'nova' ) => 'least-commented',
      esc_html__( 'Random order', 'nova' ) => 'random',
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
      'group' 		=> __('Layout Setting', 'reddot-plugin')
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
    'heading'     => esc_html__( 'Limit', 'nova' ),
    'description' => esc_html__( 'Maximum number of Images to add. Max of 60', 'nova' ),
    'type'        => 'textfield',
    'param_name'  => 'limit',
    'admin_label' => true,
    'value'       => 5,
    'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),
  array(
    'heading'     => esc_html__( 'Image size', 'nova' ),
    'type'        => 'dropdown',
    'param_name'  => 'image_size',
    'value'       => array(
      esc_html__( 'Thumbnail', 'nova' ) => 'thumbnail',
      esc_html__( 'Low Resolution', 'nova' ) => 'low_resolution',
      esc_html__( 'Standard Resolution', 'nova' ) => 'standard_resolution'
    ),
    'std'         => 'thumbnail',
    'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),
  array(
    'heading'     => esc_html__( 'Image Aspect Ration', 'nova' ),
    'type'        => 'dropdown',
    'param_name'  => 'image_aspect_ration',
    'value'       => array(
      esc_html__( '1:1', 'nova' ) => '11',
      esc_html__( '16:9', 'nova' ) => '169',
      esc_html__( '4:3', 'nova' ) => '43',
      esc_html__( '2.35:1', 'nova' ) => '2351'
    ),
    'std'         => '11',
    'group' 		=> esc_html__('Layout Setting', 'reddot-plugin')
  ),

);
$carousel = nova_vc_slider_params();
$slides_column_idx = nova_get_param_index( $carousel, 'slides_column');
if($slides_column_idx){
    unset($carousel[$slides_column_idx]);
}
$shortcode_params = array_merge( $shortcode_params, $carousel);
vc_map(array(

   "name"			=> "Instagram Feed",
   "category"		=> "9AMstudio",
   "description"	=> __( 'Display Instagram photos from any non-private Instagram accounts', 'reddot-plugin' ),
   "base"			=> "instagram_feed",
   "class"			=> "",
   "icon"			=> get_template_directory_uri() . "/assets/images/vc/instagram.png",
   "params" 		=> $shortcode_params

));
