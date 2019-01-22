<?php
$shortcode_params = array(
  array(
      'type' => 'autocomplete',
      'heading' => __( 'Categories', 'reddot-plugin' ),
      'param_name' => 'category',
      'settings' => array(
          'multiple' => true,
          'sortable' => true,
      ),
      'save_always' => true,
      'group' 		=> __('Data Setting', 'reddot-plugin')
  ),
  array(
      'type' => 'dropdown',
      'heading' => esc_html__( 'Order by', 'reddot-plugin' ),
      'param_name' => 'orderby',
      'value' => array(
          '',
          esc_html__( 'Date', 'la-studio' ) => 'date',
          esc_html__( 'ID', 'la-studio' ) => 'ID',
          esc_html__( 'Menu order', 'la-studio' ) => 'menu_order',
          esc_html__( 'Random', 'la-studio' ) => 'rand',
          esc_html__( 'Popularity', 'la-studio' ) => 'popularity',
          esc_html__( 'Rating', 'la-studio' ) => 'rating',
          esc_html__( 'Title', 'la-studio' ) => 'title'
      ),
      'save_always' => true,
      'group' 		=> __('Data Setting', 'reddot-plugin'),
      'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'reddot-plugin' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
  ),
  array(
      'type' => 'dropdown',
      'heading' => esc_html__( 'Sort order', 'reddot-plugin' ),
      'param_name' => 'order',
      'value' => array(
          '',
          esc_html__( 'Descending', 'reddot-plugin' ) => 'DESC',
          esc_html__( 'Ascending', 'reddot-plugin' ) => 'ASC',
      ),
      'save_always' => true,
      'group' 		=> __('Data Setting', 'reddot-plugin'),
      'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'reddot-plugin' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
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
      'param_name' => 'columns',
      'value' => array(
          esc_html__('2 Columns','reddot-plugin') => '2',
          esc_html__('3 Columns','reddot-plugin') => '3',
          esc_html__('4 Columns','reddot-plugin') => '4',
          esc_html__('5 Columns','reddot-plugin') => '5',
          esc_html__('6 Columns','reddot-plugin') => '6'
      ),
      'std' => '4',
      'group' 		=> __('Layout Setting', 'reddot-plugin'),
      'dependency' => array(
          'element' => 'layout',
          'value' => 'grid'
      )
  ),
  array(
      'type' => 'nova_number',
      'heading' => esc_html__('Total items', 'reddot-plugin'),
      'description' => esc_html__('The "limit" shortcode determines how many products to show on the page', 'reddot-plugin'),
      'param_name' => 'limit',
      'value' => 12,
      'min' => -1,
      'max' => 1000,
      'group' 		=> __('Layout Setting', 'reddot-plugin')
  )
);
$carousel = nova_vc_slider_params();
$slides_column_idx = nova_get_param_index( $carousel, 'slides_column');
if($slides_column_idx){
    unset($carousel[$slides_column_idx]);
}
$shortcode_params = array_merge( $shortcode_params, $carousel);
vc_map(array(

   "name"			=> "Nova Featured products",
   "category"		=> "9AMstudio",
   "description"	=> __( 'Display featured products', 'reddot-plugin' ),
   "base"			=> "nova_featured_products",
   "class"			=> "",
   "icon"			=> "icon-wpb-wp",
   "params" 		=> $shortcode_params

));
