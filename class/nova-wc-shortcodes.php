<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Nova_WC_Shortcode {

    /**
     * Shortcode type.
     *
     * @since 3.0.0
     * @var   string
     */
    protected $type = 'products';

    /**
     * Attributes.
     *
     * @since 3.0.0
     * @var   array
     */
    protected $attributes = array();

    protected $origin_attributes = array();

    /**
     * Query args.
     *
     * @since 3.0.0
     * @var   array
     */
    protected $query_args = array();

    /**
     * Set custom visibility.
     *
     * @since 3.0.0
     * @var   bool
     */
    protected $custom_visibility = false;

    /**
     * Initialize shortcode.
     *
     * @since 3.0.0
     * @param array  $attributes Shortcode attributes.
     * @param string $type       Shortcode type.
     */
    public function __construct( $attributes = array(), $type = 'products' ) {
        $this->type       = $type;
        $this->attributes = $this->parse_attributes( $attributes );
        $this->query_args = $this->parse_query_args();
        $this->origin_attributes = $attributes;
    }

    /**
     * Get shortcode attributes.
     *
     * @since  3.0.0
     * @return array
     */
    public function get_attributes() {
        return $this->attributes;
    }

    /**
     * Get query args.
     *
     * @since  3.0.0
     * @return array
     */
    public function get_query_args() {
        return $this->query_args;
    }

    /**
     * Get shortcode type.
     *
     * @since  3.0.0
     * @return array
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * Get shortcode content.
     *
     * @since  3.0.0
     * @return string
     */
    public function get_content() {
        return $this->product_loop();
    }

    /**
     * Parse attributes.
     *
     * @since  3.0.0
     * @param  array $attributes Shortcode attributes.
     * @return array
     */
    protected function parse_attributes( $attributes ) {
        $attributes = $this->parse_legacy_attributes( $attributes );

        return shortcode_atts( array(
            'limit'          => '-1',      // Results limit.
            'columns'        => '4',       // Number of columns.
            'orderby'        => 'title',   // menu_order, title, date, rand, price, popularity, rating, or id.
            'order'          => 'ASC',     // ASC or DESC.
            'ids'            => '',        // Comma separated IDs.
            'skus'           => '',        // Comma separated SKUs.
            'category'       => '',        // Comma separated category slugs.
            'cat_operator'   => 'IN',      // Operator to compare categories. Possible values are 'IN', 'NOT IN', 'AND'.
            'attribute'      => '',        // Single attribute slug.
            'terms'          => '',        // Comma separated term slugs.
            'terms_operator' => 'IN',      // Operator to compare terms. Possible values are 'IN', 'NOT IN', 'AND'.
            'visibility'     => 'visible', // Possible values are 'visible', 'catalog', 'search', 'hidden'.
            'class'          => '',        // HTML class.

            'shortcode_id'   => '',
            'paged'          => '1',
            'layout'         => 'grid',         // Accept 'grid', 'list', 'masonry',
            'grid_style'     => '1',
            'list_style'     => '1',
            'masonry_style'  => '1',
            'item_space'                => 'default',
            'enable_custom_image_size'  => 'no',
            'disable_alt_image'         => 'no',
            'enable_carousel'           => 'no',
            'img_size'                  => 'shop_catalog',
            'enable_loadmore'           => 'no',
            'load_more_text'            => ''
        ), $attributes, $this->type );
    }

    /**
     * Parse legacy attributes.
     *
     * @since  3.0.0
     * @param  array $attributes Attributes.
     * @return array
     */
    protected function parse_legacy_attributes( $attributes ) {
        $mapping = array(
            'per_page' => 'limit',
            'operator' => 'cat_operator',
            'filter'   => 'terms',
            'el_class' => 'class'
        );

        foreach ( $mapping as $old => $new ) {
            if ( isset( $attributes[ $old ] ) ) {
                $attributes[ $new ] = $attributes[ $old ];
                unset( $attributes[ $old ] );
            }
        }

        return $attributes;
    }

    /**
     * Parse query args.
     *
     * @since  3.0.0
     * @return array
     */
    protected function parse_query_args() {
        $query_args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
            'orderby'             => $this->attributes['orderby'],
            'order'               => strtoupper( $this->attributes['order'] )
        );

        // @codingStandardsIgnoreStart
        $query_args['posts_per_page'] = (int) $this->attributes['limit'];
        $query_args['paged']          = (int) $this->attributes['paged'];
        $query_args['meta_query']     = WC()->query->get_meta_query();
        $query_args['tax_query']      = array();
        // @codingStandardsIgnoreEnd


        if('yes' == $this->attributes['enable_loadmore']){
//            if(isset($this->attributes['maximum_item'])){
//                $maximum_item = $this->attributes['maximum_item'];
//            }
//            else{
//                $maximum_item = -1;
//                $this->attributes['maximum_item'] = -1;
//            }
//            $query_args['posts_per_page'] = $maximum_item;
        }

        // Visibility.
        $this->set_visibility_query_args( $query_args );

        // SKUs.
        $this->set_skus_query_args( $query_args );

        // IDs.
        $this->set_ids_query_args( $query_args );

        // Set specific types query args.
        if ( method_exists( $this, "set_{$this->type}_query_args" ) ) {
            $this->{"set_{$this->type}_query_args"}( $query_args );
        }

        // Attributes.
        $this->set_attributes_query_args( $query_args );

        // Categories.
        $this->set_categories_query_args( $query_args );

        return apply_filters( 'woocommerce_shortcode_products_query', $query_args, $this->attributes, $this->type );
    }

    /**
     * Set skus query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_skus_query_args( &$query_args ) {
        if ( ! empty( $this->attributes['skus'] ) ) {
            $skus = array_map( 'trim', explode( ',', $this->attributes['skus'] ) );
            $query_args['meta_query'][] = array(
                'key'     => '_sku',
                'value'   => 1 === count( $skus ) ? $skus[0] : $skus,
                'compare' => 1 === count( $skus ) ? '=' : 'IN',
            );
        }
    }

    /**
     * Set ids query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_ids_query_args( &$query_args ) {
        if ( ! empty( $this->attributes['ids'] ) ) {
            $ids = array_map( 'trim', explode( ',', $this->attributes['ids'] ) );

            if ( 1 === count( $ids ) ) {
                $query_args['p'] = $ids[0];
            } else {
                $query_args['post__in'] = $ids;
            }
        }
    }

    /**
     * Set attributes query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_attributes_query_args( &$query_args ) {
        if ( ! empty( $this->attributes['attribute'] ) || ! empty( $this->attributes['terms'] ) ) {
            $query_args['tax_query'][] = array(
                'taxonomy' => strstr( $this->attributes['attribute'], 'pa_' ) ? sanitize_title( $this->attributes['attribute'] ) : 'pa_' . sanitize_title( $this->attributes['attribute'] ),
                'terms'    => array_map( 'sanitize_title', explode( ',', $this->attributes['terms'] ) ),
                'field'    => 'slug',
                'operator' => $this->attributes['terms_operator'],
            );
        }
    }

    /**
     * Set categories query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_categories_query_args( &$query_args ) {
        if ( ! empty( $this->attributes['category'] ) ) {
            $ordering_args = WC()->query->get_catalog_ordering_args( $query_args['orderby'], $query_args['order'] );
            $query_args['orderby']  = $ordering_args['orderby'];
            $query_args['order']    = $ordering_args['order'];
            // @codingStandardsIgnoreStart
            $query_args['meta_key'] = $ordering_args['meta_key'];
            // @codingStandardsIgnoreEnd

            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'terms'    => array_map( 'sanitize_title', explode( ',', $this->attributes['category'] ) ),
                'field'    => 'slug',
                'operator' => $this->attributes['cat_operator'],
            );
        }
    }

    /**
     * Set sale products query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_sale_products_query_args( &$query_args ) {
        $query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
    }

    /**
     * Set best selling products query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_best_selling_products_query_args( &$query_args ) {
        // @codingStandardsIgnoreStart
        $query_args['meta_key'] = 'total_sales';
        // @codingStandardsIgnoreEnd
        $query_args['order']    = 'DESC';
        $query_args['orderby']  = 'meta_value_num';
    }

    /**
     * Set visibility as hidden.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_visibility_hidden_query_args( &$query_args ) {
        $this->custom_visibility = true;
        $query_args['tax_query'][] = array(
            'taxonomy'         => 'product_visibility',
            'terms'            => array( 'exclude-from-catalog', 'exclude-from-search' ),
            'field'            => 'name',
            'operator'         => 'AND',
            'include_children' => false,
        );
    }

    /**
     * Set visibility as catalog.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_visibility_catalog_query_args( &$query_args ) {
        $this->custom_visibility = true;
        $query_args['tax_query'][] = array(
            'taxonomy'         => 'product_visibility',
            'terms'            => 'exclude-from-search',
            'field'            => 'name',
            'operator'         => 'IN',
            'include_children' => false,
        );
        $query_args['tax_query'][] = array(
            'taxonomy'         => 'product_visibility',
            'terms'            => 'exclude-from-catalog',
            'field'            => 'name',
            'operator'         => 'NOT IN',
            'include_children' => false,
        );
    }

    /**
     * Set visibility as search.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_visibility_search_query_args( &$query_args ) {
        $this->custom_visibility = true;
        $query_args['tax_query'][] = array(
            'taxonomy'         => 'product_visibility',
            'terms'            => 'exclude-from-catalog',
            'field'            => 'name',
            'operator'         => 'IN',
            'include_children' => false,
        );
        $query_args['tax_query'][] = array(
            'taxonomy'         => 'product_visibility',
            'terms'            => 'exclude-from-search',
            'field'            => 'name',
            'operator'         => 'NOT IN',
            'include_children' => false,
        );
    }

    /**
     * Set visibility as featured.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_visibility_featured_query_args( &$query_args ) {
        // @codingStandardsIgnoreStart
        $query_args['tax_query'] = array_merge( $query_args['tax_query'], WC()->query->get_tax_query() );
        // @codingStandardsIgnoreEnd

        $query_args['tax_query'][] = array(
            'taxonomy'         => 'product_visibility',
            'terms'            => 'featured',
            'field'            => 'name',
            'operator'         => 'IN',
            'include_children' => false,
        );
    }

    /**
     * Set visibility query args.
     *
     * @since 3.0.0
     * @param array $query_args Query args.
     */
    protected function set_visibility_query_args( &$query_args ) {
        if ( method_exists( $this, 'set_visibility_' . $this->attributes['visibility'] . '_query_args' ) ) {
            $this->{'set_visibility_' . $this->attributes['visibility'] . '_query_args'}( $query_args );
        } else {
            // @codingStandardsIgnoreStart
            $query_args['tax_query'] = array_merge( $query_args['tax_query'], WC()->query->get_tax_query() );
            // @codingStandardsIgnoreEnd
        }
    }


    /**
     * Set product as visible when quering for hidden products.
     *
     * @since  3.0.0
     * @param  bool $visibility Product visibility.
     * @return bool
     */
    public function set_product_as_visible( $visibility ) {
        return $this->custom_visibility ? true : $visibility;
    }

    /**
     * Get wrapper classes.
     * @return array
     */
    protected function get_wrapper_classes() {
        $classes = array( 'woocommerce' );
        $classes[] = $this->attributes['class'];
        return $classes;
    }

    protected function get_wrapper_shortcode_id(){
        if(!empty($this->attributes['shortcode_id'])){
            $shortcode_id = $this->attributes['shortcode_id'];
        }
        else{
            $shortcode_id = uniqid($this->type . '_');
        }
        return $shortcode_id;
    }

    /**
     * Get products.
     *
     * @since  3.0.0
     * @return WP_Query
     */
    protected function get_products() {
        $transient_name = 'wc_loop' . substr( md5( wp_json_encode( $this->query_args ) . $this->type ), 28 ) . WC_Cache_Helper::get_transient_version( 'product_query' );
        $products       = get_transient( $transient_name );

        if ( false === $products || ! is_a( $products, 'WP_Query' ) ) {
            if ( 'top_rated_products' === $this->type ) {
                add_filter( 'posts_clauses', array( __CLASS__, 'order_by_rating_post_clauses' ) );
                $products = new WP_Query( $this->query_args );
                remove_filter( 'posts_clauses', array( __CLASS__, 'order_by_rating_post_clauses' ) );
            } else {
                $products = new WP_Query( $this->query_args );
            }

            set_transient( $transient_name, $products, DAY_IN_SECONDS * 30 );
        }

        // Remove ordering query arguments.
        if ( ! empty( $this->attributes['category'] ) ) {
            WC()->query->remove_ordering_args();
        }

        return $products;
    }

    /**
     * Loop over found products.
     *
     * @since  3.0.0
     * @return string
     */
    protected function product_loop() {

        $globalVar                  = apply_filters('LaStudio/global_loop_variable', 'lastudio_loop');
        $globalVarTmp               = (isset($GLOBALS[$globalVar]) ? $GLOBALS[$globalVar] : '');
        $globalParams               = array();

        $unique_id                  = $this->get_wrapper_shortcode_id();
        $wrapper_classes            = $this->get_wrapper_classes();
        $columns                    = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts( $this->attributes['columns'] );
        $layout                     = !empty($this->attributes['layout']) ? $this->attributes['layout'] : 'grid';
        $style                      = $this->attributes[$layout . '_style'];
        $item_space                 = $this->attributes['item_space'];

        $paged                      = (int) $this->attributes['paged'];

        $loopCssClass 	= array();
        $carousel_configs = $disable_alt_image = $image_size = false;
        if( 'yes' == $this->attributes['enable_custom_image_size'] ) {
            $image_size = true;
        }
        if( 'yes' == $this->attributes['disable_alt_image'] ) {
            $disable_alt_image = true;
        }
        if( $layout == 'grid' ){
            if( 'yes' == $this->attributes['enable_carousel'] ) {
                $carousel_configs = ' data-la_component="AutoCarousel" ';
                $carousel_configs .= LaStudio_Shortcodes_Helper::getParamCarouselShortCode( $this->origin_attributes );
                $loopCssClass[] = 'js-el la-slick-slider';
            }
        }

        $globalParams['loop_id']        = $unique_id;
        $globalParams['loop_layout']    = $layout;
        $globalParams['loop_style']     = $style;
        $globalParams['item_space']     = $item_space;
        if($image_size){
            $globalParams['image_size'] = LaStudio_Shortcodes_Helper::getImageSizeFormString( $this->attributes['img_size'] );
        }
        if($disable_alt_image){
            $globalParams['disable_alt_image'] = true;
        }
        $GLOBALS[$globalVar] = $globalParams;

        $loopCssClass[] = 'products';
        $loopCssClass[] = 'products-' . $layout;
        $loopCssClass[] = 'products-' . $layout . '-' . $style;
        $loopCssClass[] = 'grid-items';

        if($layout != 'list'){
            foreach( $columns as $screen => $value ){
                $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
            }
            $loopCssClass[] = 'grid-space-' . $item_space;
        }

        $products               = $this->get_products();

        $GLOBALS[$globalVar]    = $globalParams;

        $loop_tpl               = array();
        $loop_tpl[]             = "woocommerce/content-product-{$layout}-{$style}.php";
        $loop_tpl[]             = "woocommerce/content-product-{$layout}.php";
        $loop_tpl[]             = "woocommerce/content-product.php";


        ob_start();

        if ( $products->have_posts() ) {

            // Prime caches before grabbing objects.
            update_post_caches( $products->posts, array( 'product', 'product_variation' ) );

            do_action('LaStudio/shortcodes/before_loop', 'woo_shortcode', $this->type, $this->origin_attributes);

            do_action( "woocommerce_shortcode_before_{$this->type}_loop", $this->attributes );

            echo sprintf(
                '<div class="row"><div class="col-xs-12"><ul class="%s"%s>',
                esc_attr(implode(' ', $loopCssClass)),
                $carousel_configs ? $carousel_configs : ''
            );

            while ( $products->have_posts() ) {

                $products->the_post();

                // Set custom product visibility when quering hidden products.
                add_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );

                // Render product template.
                locate_template($loop_tpl, true, false);

                // Restore product visibility.
                remove_action( 'woocommerce_product_is_visible', array( $this, 'set_product_as_visible' ) );
            }

            echo '</ul></div></div>';

            do_action( "woocommerce_shortcode_after_{$this->type}_loop", $this->attributes );

            do_action('LaStudio/shortcodes/after_loop', 'woo_shortcode', $this->type, $this->origin_attributes);

        } else {

            do_action( "woocommerce_shortcode_{$this->type}_loop_no_results", $this->attributes );

        }


        if( 'yes' == $this->attributes['enable_loadmore'] ) {
            echo sprintf(
                '<div class="elm-loadmore-ajax" data-query-settings="%s" data-request="%s" data-paged="%s" data-max-page="%s" data-container="#%s ul.products" data-item-class=".product_item">%s<a href="#">%s</a></div>',
                esc_attr( wp_json_encode( array(
                    'tag' => $this->type,
                    'atts' => $this->origin_attributes
                ) ) ),
                esc_url( admin_url( 'admin-ajax.php', 'relative' ) ),
                esc_attr($this->attributes['paged']),
                esc_attr($products->max_num_pages),
                esc_attr($unique_id),
                LaStudio_Shortcodes_Helper::getLoadingIcon(),
                esc_html($this->attributes['load_more_text'])
            );
        }


        $GLOBALS[$globalVar] = $globalVarTmp;

        woocommerce_reset_loop();
        wp_reset_postdata();

        return '<div id="'.esc_attr( $unique_id ).'" class="' . esc_attr( implode( ' ', $wrapper_classes ) ) . '">' . ob_get_clean() . '</div>';
    }

    /**
     * Order by rating.
     *
     * @since  3.0.0
     * @param  array $args Query args.
     * @return array
     */
    public static function order_by_rating_post_clauses( $args ) {
        global $wpdb;

        $args['where']   .= " AND $wpdb->commentmeta.meta_key = 'rating' ";
        $args['join']    .= "LEFT JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID) LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)";
        $args['orderby'] = "$wpdb->commentmeta.meta_value DESC";
        $args['groupby'] = "$wpdb->posts.ID";

        return $args;
    }

}
