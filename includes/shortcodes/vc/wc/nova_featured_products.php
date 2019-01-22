<?php
$shortcode_params = array(
  array(
      'type' => 'autocomplete',
      'heading' => __( 'Categories', 'reddot' ),
      'param_name' => 'category',
      'settings' => array(
          'multiple' => true,
          'sortable' => true,
      ),
      'save_always' => true,
      'group' 		=> __('Data Setting', 'reddot')
  ),
  array(
      'type'       => 'checkbox',
      'heading'    => __('Enable slider', 'reddot' ),
      'param_name' => 'enable_carousel',
      'value'      => array( __( 'Yes', 'reddot' ) => 'yes' ),
      'group' 		=> __('Layout Setting', 'lastudio')
  )
);
$carousel = nova_vc_slider_params();
$shortcode_params = array_merge( $shortcode_params, $carousel);
vc_map(array(

   "name"			=> "Nova Featured products",
   "category"		=> "9AMstudio",
   "description"	=> __( 'Display featured products', 'reddot' ),
   "base"			=> "nova_featured_products",
   "class"			=> "",
   "icon"			=> "icon-wpb-wp",
   "params" 		=> $shortcode_params

));
