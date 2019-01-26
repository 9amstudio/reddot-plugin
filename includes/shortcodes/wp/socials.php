<?php

// [socials]

function nova_shortcode_socials($atts, $content = null) {	

	extract(shortcode_atts(array(
		"align"       => "left",
        "fontsize"    => "",
        "fontcolor"   => "",
	), $atts));

    $size  = $fontsize != ""  ? "font-size:" . $fontsize . "px;" : "";
    $color = $fontcolor != "" ? "color:" . $fontcolor . ";" : "";
    $style = ($size != "" || $color != "") ? "style='".$size."".$color."'" : "";

    ob_start();
    ?>

    <ul class="shortcode_socials <?php echo esc_html($align); ?>">
        
        <?php

        if ( Nova_OP::getOption('facebook_link')   != "" )     echo '<li><a href="' . Nova_OP::getOption('facebook_link') . '"    target="_blank" '.$style.'><i class="reddot-icons-facebook-f"></i>  <span>Facebook</span>   </a></li>';
        if ( Nova_OP::getOption('twitter_link')    != "" )     echo '<li><a href="' . Nova_OP::getOption('twitter_link') . '"     target="_blank" '.$style.'><i class="reddot-icons-twitter"></i>     <span>Twitter</span>    </a></li>';
        if ( Nova_OP::getOption('pinterest_link')  != "" )     echo '<li><a href="' . Nova_OP::getOption('pinterest_link') . '"   target="_blank" '.$style.'><i class="reddot-icons-pinterest"></i>   <span>Pinterest</span>  </a></li>';
        if ( Nova_OP::getOption('linkedin_link')   != "" )     echo '<li><a href="' . Nova_OP::getOption('linkedin_link') . '"    target="_blank" '.$style.'><i class="reddot-icons-linkedin"></i>    <span>Linkedin</span>   </a></li>';
        if ( Nova_OP::getOption('googleplus_link') != "" )     echo '<li><a href="' . Nova_OP::getOption('googleplus_link') . '"  target="_blank" '.$style.'><i class="reddot-icons-google2"></i>     <span>Googleplus</span> </a></li>';
        if ( Nova_OP::getOption('rss_link')        != "" )     echo '<li><a href="' . Nova_OP::getOption('rss_link') . '"         target="_blank" '.$style.'><i class="reddot-icons-rss"></i>         <span>RSS</span>        </a></li>';
        if ( Nova_OP::getOption('tumblr_link')     != "" )     echo '<li><a href="' . Nova_OP::getOption('tumblr_link') . '"      target="_blank" '.$style.'><i class="reddot-icons-tumblr"></i>      <span>Tumblr</span>     </a></li>';
        if ( Nova_OP::getOption('instagram_link')  != "" )     echo '<li><a href="' . Nova_OP::getOption('instagram_link') . '"   target="_blank" '.$style.'><i class="reddot-icons-instagram"></i>   <span>Instagram</span>  </a></li>';
        if ( Nova_OP::getOption('youtube_link')    != "" )     echo '<li><a href="' . Nova_OP::getOption('youtube_link') . '"     target="_blank" '.$style.'><i class="reddot-icons-youtube2"></i>    <span>Youtube</span>    </a></li>';
        if ( Nova_OP::getOption('vimeo_link')      != "" )     echo '<li><a href="' . Nova_OP::getOption('vimeo_link') . '"       target="_blank" '.$style.'><i class="reddot-icons-vimeo"></i>       <span>Vimeo</span>      </a></li>';
        if ( Nova_OP::getOption('behance_link')    != "" )     echo '<li><a href="' . Nova_OP::getOption('behance_link') . '"     target="_blank" '.$style.'><i class="reddot-icons-behance"></i>     <span>Behance</span>    </a></li>';
        if ( Nova_OP::getOption('dribbble_link')   != "" )     echo '<li><a href="' . Nova_OP::getOption('dribbble_link') . '"    target="_blank" '.$style.'><i class="reddot-icons-dribbble"></i>    <span>Dribbble</span>   </a></li>';
        if ( Nova_OP::getOption('flickr_link')     != "" )     echo '<li><a href="' . Nova_OP::getOption('flickr_link') . '"      target="_blank" '.$style.'><i class="reddot-icons-flickr"></i>      <span>Flickr</span>     </a></li>';
        if ( Nova_OP::getOption('git_link')        != "" )     echo '<li><a href="' . Nova_OP::getOption('git_link') . '"         target="_blank" '.$style.'><i class="reddot-icons-github"></i>      <span>Github</span>     </a></li>';
        if ( Nova_OP::getOption('skype_link')      != "" )     echo '<li><a href="' . Nova_OP::getOption('skype_link') . '"       target="_blank" '.$style.'><i class="reddot-icons-skype"></i>       <span>Skype</span>      </a></li>';
        if ( Nova_OP::getOption('weibo_link')      != "" )     echo '<li><a href="' . Nova_OP::getOption('weibo_link') . '"       target="_blank" '.$style.'><i class="reddot-icons-sina-weibo"></i>  <span>Weibo</span>      </a></li>';
        if ( Nova_OP::getOption('foursquare_link') != "" )     echo '<li><a href="' . Nova_OP::getOption('foursquare_link') . '"  target="_blank" '.$style.'><i class="reddot-icons-foursquare2"></i> <span>Foursquare</span> </a></li>';
        if ( Nova_OP::getOption('soundcloud_link') != "" )     echo '<li><a href="' . Nova_OP::getOption('soundcloud_link') . '"  target="_blank" '.$style.'><i class="reddot-icons-soundcloud"></i>  <span>Soundcloud</span> </a></li>';
        if ( Nova_OP::getOption('snapchat_link')   != "" )     echo '<li><a href="' . Nova_OP::getOption('snapchat_link') . '"    target="_blank" '.$style.'><i class="reddot-icons-snapchat"></i>    <span>Snapchat</span>   </a></li>';
        ?>

    </ul>
    
    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("socials", "nova_shortcode_socials");