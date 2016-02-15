<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Theme Setup
|--------------------------------------------------------------------------
*/

// Soil
add_theme_support('soil-clean-up');
add_theme_support('soil-relative-urls');
add_theme_support('soil-js-to-footer');
add_theme_support('soil-disable-trackbacks');
add_theme_support('soil-disable-asset-versioning');

// Set the content width based on the theme's design and stylesheet.
if ( !isset($content_width) )
{
    $content_width = 1000; /* pixels */
}

add_action('after_setup_theme', function()
{
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // WP 4.1 title support
    add_theme_support('title-tag');

    // WooCommerce support
    add_theme_support('woocommerce');

    // Add navigation menu
    register_nav_menus([
        'primary' => __('Primary Navigation', 'defender'),
        'footer'  => __('Footer Navigation', 'defender')
    ]);

    // Enable support for featured posts including custom post types
    add_theme_support('post-thumbnails');

    // Thumbnails
    add_image_size('cart_thumbnail', 50, 78, true);
});
