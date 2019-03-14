<?php

//http://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336



// CREATE

add_action( 'add_meta_boxes', 'nova_page_options_meta_box_add' );

function nova_page_options_meta_box_add() {
    add_meta_box( 'page_options_meta_box', esc_html__('Page Options','reddot'), 'nova_page_options_meta_box_content', 'page', 'side', 'high' );
}

function nova_page_options_meta_box_content() {
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values						= get_post_custom( $post->ID );
    $header_transparency		= isset($values['metabox_header_transparency']) ? esc_attr( $values['metabox_header_transparency'][0]) : '';
	$page_header_enable			= isset($values['meta_box_page_header_enable']) ? esc_attr($values['meta_box_page_header_enable'][0]) : 'on';
    ?>
    <p><strong><?php esc_html_e('Header Transparency','reddot') ?></strong></p>

    <p>
        <select name="metabox_header_transparency" id="metabox_header_transparency" style="width:100%">
            <option value="inherit" <?php selected( $header_transparency, 'inherit' ); ?>><?php esc_html_e('Inherit','reddot') ?></option>
            <option value="transparency_light" <?php selected( $header_transparency, 'transparency_light' ); ?>><?php esc_html_e('Light','reddot') ?></option>
            <option value="transparency_dark" <?php selected( $header_transparency, 'transparency_dark' ); ?>><?php esc_html_e('Dark','reddot') ?></option>
            <option value="no_transparency" <?php selected( $header_transparency, 'no_transparency' ); ?>><?php esc_html_e('No Transparency','reddot') ?></option>
        </select>
    </p>
    <p><strong>Page Header</strong></p>
    <p>
        <input type="checkbox" id="meta_box_page_header_enable" name="meta_box_page_header_enable" <?php checked( $page_header_enable, 'on' ); ?> />
        <label for="meta_box_page_header_enable"><?php esc_html_e('Show Page Header','reddot') ?></label>
    </p>

    <?php

	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'page_options_meta_box', 'page_options_meta_box_nonce' );
}




// SAVE

add_action( 'save_post', 'nova_page_options_meta_box_save' );

function nova_page_options_meta_box_save($post_id) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['page_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['page_options_meta_box_nonce'], 'page_options_meta_box' ) ) return;

    // if our current user can't edit this post, bail
    if ( !current_user_can( 'edit_post', $post_id ) ) return;

    if( isset( $_POST['metabox_header_transparency'] ) )
      update_post_meta( $post_id, 'metabox_header_transparency', esc_attr( $_POST['metabox_header_transparency'] ) );

    $page_header_chk = isset($_POST['meta_box_page_header_enable']) ? 'on' : 'off';
    update_post_meta( $post_id, 'meta_box_page_header_enable', $page_header_chk );

}
