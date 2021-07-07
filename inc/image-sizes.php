<?php
/**
 * Custom image sizes.
 */

/**
 * Additional image sizes
 */
add_image_size( 'square-small', 480, 480, array( 'center', 'center' ) );
add_image_size( 'square-medium', 640, 640, array( 'center', 'center' ) );
add_filter( 'image_size_names_choose', 'loonymoon_add_image_sizes' );
// Add sizes to media admin
function loonymoon_add_image_sizes( $sizes ) {
    $addsizes = array(
        "square-small" => __( "Square Small"),
        "square-medium" => __( "Square Medium"),
    );
    $newsizes = array_merge( $sizes, $addsizes );
    return $newsizes;
}

/**
 * Resize attachment page image
 */
add_filter( 'prepend_attachment', 'loonymoon_prepend_attachment' );
function loonymoon_prepend_attachment( $p ) {
    return '<p class="attachment">' . wp_get_attachment_link( 0, 'large', false ) . '</p>';
}