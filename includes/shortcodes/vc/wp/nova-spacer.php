<?php

/*
**	Nova Spacer
*/

vc_map(array(

   "name"			=> "Nova Spacer",
   "category"		=> "9AMstudio",
   "base"			=> "nova_spacer",
   "class"			=> "",
   "icon"			=> get_template_directory_uri() . "/assets/images/vc/spacer.png",


   "params" 	=> array(
     array(
         'type' 			=> 'nova_column',
         'heading' 		=> __('Space Height', 'reddot-plugin'),
         'admin_label'   => true,
         'param_name' 	=> 'height',
         'unit'			=> 'px',
         'media'			=> array(
             'xlg'	=> '',
             'lg'	=> '',
             'md'	=> '',
             'sm'	=> '',
             'xs'	=> '',
             'mb'	=> ''
         )
     ),
   )

));
