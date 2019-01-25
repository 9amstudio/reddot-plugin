<?php

/*
**	Nova Heading
*/

vc_map(array(

   "name"			=> "Nova Heading",
   "category"		=> "9AMstudio",
   "base"			=> "nova_heading",
   "class"			=> "",
   "icon"			=> get_template_directory_uri() . "/assets/images/vc/heading.png",


   "params" 	=> array(
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
   )

));
