<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

// Add classes to body

add_filter('body_class', function($classes)
{
    global $post;

    // Page slug
    if ( isset($post) and !is_home() )
    {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }

    // Post categories
    elseif ( isset($post) and is_single() )
    {
        foreach ( get_the_category($post->ID) as $category )
        {
            $classes[] = 'category-' . $category->category_nicename;
        }
    }

    return $classes;
});


// Fix https and http attachment/thumbnail URLs
add_filter('wp_get_attachment_url', 'set_url_scheme');

// Auto populate submission form
function defender_query_vars($public_vars) {
    $new_public_vars = [
        'ticket_product',
        'ticket_version',
        'ticket_filled',
        'ticket_osversion',
        'ticket_browser',
        'ticket_freeram',
        'ticket_disks',
        'ticket_winpath',
        'ticket_root',
        'ticket_userdir',
        'ticket_screen',
        'ticket_locale',
        'ticket_programdir',
        'ticket_key',
        'feedback_text',
        'feedback_product',
        'feedback_email',
        'feedback_version',
        'feedback_hash',
        'feedback_key',
        'install_software'
    ];
    $public_vars = array_merge($public_vars, $new_public_vars);
    return $public_vars;
}

add_filter('query_vars', 'defender_query_vars');

// Include the heading partial in a template
function defender_print_page_heading($args = [])
{
    if ( isset($args['acf_page_id']) )        set_query_var('heading_acf_page_id', $args['acf_page_id']);
    if ( isset($args['heading_background']) ) set_query_var('heading_background',  $args['heading_background']);
    if ( isset($args['heading_title']) )      set_query_var('heading_title',       $args['heading_title']);
    if ( isset($args['heading_subtitle']) )   set_query_var('heading_subtitle',    $args['heading_subtitle']);
    get_template_part('partials/content', 'heading');
}
