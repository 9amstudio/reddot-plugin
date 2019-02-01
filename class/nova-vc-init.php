<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Nova_Visual_Composer{

    protected $category;

    public function __construct(){
        if(!class_exists('Vc_Manager')) return false;
        $this->load_hooks();
    }

    private function load_hooks(){
        $this->category = esc_html_x( '9AMstudio', 'admin-view', 'reddot-plugin');
        add_action( 'vc_before_init', array( $this, 'vc_before_init') );
        add_action( 'vc_after_init', array( $this, 'vc_after_init') );
        add_filter( 'vc_tta_container_classes', array( $this, 'vc_tta_container_classes'), 12, 2 );
        add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG , array( $this, 'modify_shortcode_css_class_output' ), 12, 3 );
    }

    public function vc_before_init(){
        vc_automapper()->setDisabled( true );
        vc_manager()->disableUpdater( true );
        vc_manager()->setIsAsTheme( true );
        if(class_exists( 'WooCommerce' )){
            remove_action( 'wp_enqueue_scripts', 'vc_woocommerce_add_to_cart_script' );
        }
    }

    public function vc_after_init(){
        $this->overrideTtaTabs();
    }
    public function vc_tta_container_classes($classes, $atts){
        if(isset($atts['style']) && strpos($atts['style'],'nova-') !== false && isset($atts['alignment'])){
            $classes[] = 'vc_tta-' . $atts['style'];
            $classes[] = 'vc_tta-alignment-' . $atts['alignment'];
        }
        return $classes;
    }

    public function modify_shortcode_css_class_output($css_classes, $shortcode_name, $atts){
        if ( $shortcode_name == 'vc_tta_tabs' || $shortcode_name == 'vc_tta_accordion' || $shortcode_name == 'vc_tta_tour' ){
            if( isset($atts['style']) && strpos($atts['style'], 'nova-') !== false ){
                $css_classes = preg_replace('/ vc_tta-(o|shape|spacing|gap|color)[0-9a-zA-Z\_\-]+/','',$css_classes);
                if($shortcode_name == 'vc_tta_tabs'){
                    $css_classes .= ' vc_tta-o-no-fill';
                    $css_classes = str_replace('vc_tta-style-','tabs-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
                if($shortcode_name == 'vc_tta_tour'){
                    $css_classes = str_replace('vc_tta-style-','tour-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
            }
        }

        if ( $shortcode_name == 'vc_row' ) {
            $css_classes .= ' la_fp_slide la_fp_child_section';
        }

        return $css_classes;
    }
    private function overrideTtaTabs(){
        vc_map_update( 'vc_tta_tabs', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => _x( 'Widget title', 'admin-view', 'reddot-plugin' ),
                    'description' => _x( 'Enter text used as widget title (Note: located above content element).', 'admin-view', 'reddot-plugin' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Reddot 01', 'admin-view', 'reddot-plugin' ) => 'nova-1',
                        esc_html_x( 'Classic', 'admin-view', 'reddot-plugin' ) => 'classic',
                        esc_html_x( 'Modern', 'admin-view', 'reddot-plugin' ) => 'modern',
                        esc_html_x( 'Flat', 'admin-view', 'reddot-plugin' ) => 'flat',
                        esc_html_x( 'Outline', 'admin-view', 'reddot-plugin' ) => 'outline',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs display style.', 'admin-view', 'reddot-plugin' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html_x( 'Rounded', 'admin-view', 'reddot-plugin' ) => 'rounded',
                        esc_html_x( 'Square', 'admin-view', 'reddot-plugin' ) => 'square',
                        esc_html_x( 'Round', 'admin-view', 'reddot-plugin' ) => 'round',
                    ),
                    'heading' => esc_html_x( 'Shape', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs shape.', 'admin-view', 'reddot-plugin' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'heading' => esc_html_x( 'Color', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs color.', 'admin-view', 'reddot-plugin' ),
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),

                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill_content_area',
                    'heading' => esc_html_x( 'Do not fill content area?', 'admin-view', 'reddot-plugin' ),
                    'std' => 'true',
                    'description' => esc_html_x( 'Do not fill content area with color.', 'admin-view', 'reddot-plugin' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'reddot-plugin' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Spacing', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs spacing.', 'admin-view', 'reddot-plugin' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'reddot-plugin' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Gap', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs gap.', 'admin-view', 'reddot-plugin' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html_x( 'Top', 'admin-view', 'reddot-plugin' ) => 'top',
                        esc_html_x( 'Bottom', 'admin-view', 'reddot-plugin' ) => 'bottom',
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs navigation position.', 'admin-view', 'reddot-plugin' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'reddot-plugin' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'reddot-plugin' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'reddot-plugin' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select tabs section title alignment.', 'admin-view', 'reddot-plugin' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'reddot-plugin' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html_x( 'Autoplay', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'admin-view', 'reddot-plugin' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'reddot-plugin' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'reddot-plugin' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_style',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'reddot-plugin' ) => '',
                        esc_html_x( 'Square Dots', 'admin-view', 'reddot-plugin' ) => 'outline-square',
                        esc_html_x( 'Radio Dots', 'admin-view', 'reddot-plugin' ) => 'outline-round',
                        esc_html_x( 'Point Dots', 'admin-view', 'reddot-plugin' ) => 'flat-round',
                        esc_html_x( 'Fill Square Dots', 'admin-view', 'reddot-plugin' ) => 'flat-square',
                        esc_html_x( 'Rounded Fill Square Dots', 'admin-view', 'reddot-plugin' ) => 'flat-rounded',
                    ),
                    'heading' => esc_html_x( 'Pagination style', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select pagination style.', 'admin-view', 'reddot-plugin' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'heading' => esc_html_x( 'Pagination color', 'admin-view', 'reddot-plugin' ),
                    'description' => esc_html_x( 'Select pagination color.', 'admin-view', 'reddot-plugin' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'std' => 'grey',
                    'dependency' => array(
                        'element' => 'pagination_style',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'reddot-plugin' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'reddot-plugin' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html_x( 'CSS box', 'admin-view', 'reddot-plugin' ),
                    'param_name' => 'css',
                    'group' => esc_html_x( 'Design Options', 'admin-view', 'reddot-plugin' ),
                ),
            )
        ));
    }

}
