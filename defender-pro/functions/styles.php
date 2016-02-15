<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
*/

add_action('wp_enqueue_scripts', function()
{
    $css_path = str_replace(['http:', 'https:'], '', get_template_directory_uri() . '/css/');

    // Semantic UI
    wp_register_style('semantic-ui', $css_path . 'semantic.min.css');

    // Theme styles
    wp_enqueue_style('style', $css_path . 'style.min.css', ['semantic-ui']);
    if ( is_page_template( 'landing-page-maccleanse.php') ) {
        wp_enqueue_style('opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,300');
    }

    if ( strpos( get_page_template(),'removescript') !== false) {
        wp_dequeue_style( 'style' );
    }

});
