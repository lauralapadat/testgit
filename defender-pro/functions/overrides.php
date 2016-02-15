<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Overrides
|--------------------------------------------------------------------------
*/

// Override URL to uploads in advanced custom fields content
function copydvd_cdn_acf_values($value, $post_id, $field)
{
    if ( WP_CDNURL != WP_HOME )
    {
        $value = preg_replace([
            '/' . preg_quote('src="' . WP_HOME . '/wp-content', '/') . '/',
            '/' . preg_quote('src="/wp-content', '/') . '/',
        ], 'src="' . WP_CONTENT_URL, $value);
    }

    return $value;
}

add_filter('acf/format_value/type=textarea', 'copydvd_cdn_acf_values', 10, 3);
add_filter('acf/format_value/type=text', 'copydvd_cdn_acf_values', 10, 3);
add_filter('acf/format_value/type=wysiwyg_editor', 'copydvd_cdn_acf_values', 10, 3);


// Override number of posts for products
function defender_override_post_count($query)
{
    if ( !is_post_type_archive('product') and !is_post_type_archive('video_guide') )
    {
        return;
    }

    $query->set('posts_per_page', -1);
}
add_action('pre_get_posts', 'defender_override_post_count');


// Override default email from address
/*
function defender_mail_from($address)
{
    return get_option('admin_email');
}
add_filter('wp_mail_from', 'defender_mail_from');
*/


// Override default email from name
/*
function defender_mail_from_name($name)
{
    return get_option('blogname');
}
add_filter('wp_mail_from_name', 'defender_mail_from_name');
*/

// We prefix landing pages with 'Landing Page', but do not want that to be par to of the <title>
// This filters strips 'Landing Page' from the page title
add_filter( 'wp_title', function( $title )
{
    return str_replace('Landing Page', '', $title);
});


// Override WP Query
function defender_override_wp_query($query)
{
    if ( $query->is_main_query() and !is_admin() and !is_feed() )
    {
        // Exclude pages from search results
        if ( $query->is_search )
        {
            $query->set('post_type', array('post') );
        }
    }
}
add_action('pre_get_posts', 'defender_override_wp_query');


// Turn comments and trackbacks/pingbacks off by default on post types
function defender_default_content($post_content, $post)
{
    global $post;

    if ( isset($post->post_type) and in_array($post->post_type, ['page', 'kb_article', 'product'], true) )
    {
        $post->comment_status = 'closed';
        $post->ping_status    = 'closed';
    }

    return $post_content;
}
add_filter('default_content', 'defender_default_content', 10, 2);
