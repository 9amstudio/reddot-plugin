<?php

/*
**	Nova Banner Image
*/

vc_map(array(

   "name"			=> "Banner Image",
   "category"		=> "9AMstudio",
   "description"	=> "Display the banner image with descripion",
   "base"			=> "nova_banner",
   "class"			=> "",
   "icon"			=> get_template_directory_uri() . "/assets/images/vc/banner.png",


   "params" 	=> array(
		 array(
				 'type' => 'attach_image',
				 'heading' => esc_html__('Upload the banner image', 'reddot-plugin'),
				 'param_name' => 'banner_id'
		 ),
		 array(
         'type' => 'colorpicker',
         'heading' => esc_html__('Background Overlay', 'reddot-plugin'),
         'param_name' => 'bg_overlay',
         'dependency' => array(
             'element'   => 'banner_id',
             'not_empty'     => true
         ),
         'group' => esc_html__('Design', 'reddot-plugin')
     ),
		 array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Text Color', 'reddot-plugin'),
					'param_name' => 'text_color',
					'dependency' => array(
							'element'   => 'banner_id',
							'not_empty'     => true
					),
					'group' => esc_html__('Design', 'reddot-plugin')
			),
		 array(
         'type' => 'colorpicker',
         'heading' => esc_html__('Background Overlay On Hover', 'reddot-plugin'),
         'param_name' => 'bg_overlay_hover',
         'dependency' => array(
             'element'   => 'banner_id',
             'not_empty'     => true
         ),
         'group' => esc_html__('Design', 'reddot-plugin')
     ),
		 array(
				 'type' => 'vc_link',
				 'heading' => esc_html__('Banner Link', 'reddot-plugin'),
				 'param_name' => 'banner_link',
				 'description' => esc_html__('Add link / select existing page to link to this banner', 'reddot-plugin'),
				 'dependency' => array(
						 'element'   => 'banner_id',
						 'not_empty'     => true
				 )
		 ),
		 array(
				 'type' => 'textarea_html',
				 'heading' => esc_html__('Description', 'reddot-plugin'),
				 'param_name' => 'content',
				 'dependency' => array(
						 'element'   => 'banner_id',
						 'not_empty'     => true
				 )
		 ),
   )

));
