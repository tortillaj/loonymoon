<?php


add_filter('wp_enqueue_scripts', 'loonymoon_default_jquery', PHP_INT_MAX);

function loonymoon_default_jquery()
{
    if (!is_admin()) {
        wp_dequeue_script('jquery');
        wp_deregister_script('jquery');
    }
}

/**
 * Enqueue scripts.
 */
add_action('wp_enqueue_scripts', 'loonymoon_enqueue_scripts');
function loonymoon_enqueue_scripts()
{
    $theme = wp_get_theme();

    wp_enqueue_script('jquery');

    wp_enqueue_style('tailpress', tailpress_get_mix_compiled_asset_url('css/app.css'), array(), $theme->get('Version'));
    wp_enqueue_script('tailpress', tailpress_get_mix_compiled_asset_url('js/app.js'), array('jquery'), $theme->get('Version'));
}

/**
 * Get mix compiled asset.
 *
 * @param string $path The path to the asset.
 *
 * @return string
 */
function tailpress_get_mix_compiled_asset_url($path)
{
    $path = '/' . $path;
    $mix_file_path = file_get_contents(get_stylesheet_directory() . '/mix-manifest.json');
    $manifest = json_decode($mix_file_path, true);
    $asset_path = !empty($manifest[$path]) ? $manifest[$path] : $path;

    return get_stylesheet_directory_uri() . $asset_path;
}

/**
 * Get data from the tailpress.json file.
 *
 * @param mixed $key The key to retrieve.
 *
 * @return mixed|null
 */
function tailpress_get_data($key = null)
{
    $config = json_decode(file_get_contents(get_stylesheet_directory() . '/tailpress.json'), true);

    if ($key === null) {
        return filter_var_array($config, FILTER_SANITIZE_STRING);
    }

    $option = filter_var($config[$key], FILTER_SANITIZE_STRING);

    return $option ?? null;
}

/**
 * Theme setup.
 */
add_action('after_setup_theme', 'tailpress_setup');
function tailpress_setup()
{
    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'loonymoon'),
        )
    );

    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    // Adding Thumbnail basic support.
    add_theme_support('post-thumbnails');

    // Block editor.
    add_theme_support('align-wide');

    add_theme_support('wp-block-styles');

    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');

//    add_theme_support('custom-logo');
    add_post_type_support('page', 'excerpt');

    $tailpress = tailpress_get_data();

    $colors = array_map(function ($color, $hex) {
        return array(
            'name' => ucfirst($color),
            'slug' => $color,
            'color' => $hex,
        );
    }, array_keys($tailpress['colors']), $tailpress['colors']);

    $font_sizes = array_map(function ($size, $px) {
        return array(
            'name' => ucfirst($size),
            'size' => $px,
            'slug' => $size
        );
    }, array_keys($tailpress['fontSizes']), $tailpress['fontSizes']);

    add_theme_support('editor-color-palette', $colors);
    add_theme_support('editor-font-sizes', $font_sizes);
}

/**
 * Include other functions as needed from the `inc` folder.
 */

require get_stylesheet_directory() . '/inc/setup.php';
require get_stylesheet_directory() . '/inc/image-sizes.php';
require get_stylesheet_directory() . '/inc/markup.php';
require get_stylesheet_directory() . '/inc/header.php';
