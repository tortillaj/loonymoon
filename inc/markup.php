<?php
/**
 * Alterations to WP markup
 */

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string $classes String of classes.
 * @param mixed $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
add_filter( 'nav_menu_css_class', 'loonymoon_nav_menu_add_li_class', 1, 3 );
function loonymoon_nav_menu_add_li_class( $classes, $item, $args ) {
    if ( isset( $args->li_class ) ) {
        $classes[] = $args->li_class;
    }

    return $classes;
}