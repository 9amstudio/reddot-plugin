<?php

/*
**	Nova Spacer
*/

vc_map(array(

   "name"			=> "Nova Collection",
   "category"		=> "9AMstudio",
   "base"			=> "nova_collection",
   "class"			=> "",
   "icon"			=> get_template_directory_uri() . "/assets/images/vc/collection.png",


   "params" 	=> array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Upload the collection image', 'reddot-plugin'),
			'param_name' => 'collection_id'
		),
		array(
			'heading'     => esc_html__( 'Image Position', 'nova' ),
			'type'        => 'dropdown',
			'param_name'  => 'img_pos',
			'value'       => array(
				esc_html__( 'Top', 'reddot-plugin' )    => 'top',
				esc_html__( 'Bottom', 'reddot-plugin' ) => 'bottom',
			),
			'std'         => 'bottom'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Label', 'reddot-plugin'),
			'param_name' => 'label'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'reddot-plugin'),
			'param_name' => 'title'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Sub Title', 'reddot-plugin'),
			'param_name' => 'sub_title'
		),
		array(
			"type"			=> "textarea",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Description",
			"param_name"	=> "description",
			"value"			=> "",
		),
	)

));
