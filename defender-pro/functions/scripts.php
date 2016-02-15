<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Scripts
|--------------------------------------------------------------------------
*/

add_action('wp_enqueue_scripts', function()
{
    $js_path = str_replace(['http:', 'https:'], '', get_template_directory_uri() . '/js/');

    // Remove jQuery migrate and move jQuery to footer
    wp_deregister_script('jquery');
    wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, false, true);

    // Semantic UI
    wp_register_script('semantic-ui', $js_path . 'semantic.min.js', ['jquery'], false, true);

    // Theme scripts
    wp_enqueue_script('script', $js_path . 'script.min.js', ['semantic-ui'], false, true);

    // Load comments
    if ( is_singular() && comments_open() && get_option('thread_comments') )
    {
        wp_enqueue_script('comment-reply');
    }

    // Replace WooCommerce scripts
    if ( function_exists('is_woocommerce') )
    {
        if ( !is_admin() )
        {
            // Remove select2 as we use SUI's dropdowns
            wp_dequeue_style('select2');
            wp_deregister_style('select2');
            wp_dequeue_script('select2');
            wp_deregister_script('select2');

            // Replace wc-country-select and wc-address-i18n with SUI friendly versions
            wp_deregister_script('wc-country-select');
            wp_deregister_script('wc-address-i18n');
            wp_register_script('wc-country-select', $js_path . 'wc-country-select.min.js', ['script'], false, true);
            wp_register_script('wc-address-i18n', $js_path . 'wc-address-i18n.min.js', ['script'], false, true);

            // Replace wc-checkout with SUI friendly version
            if ( is_checkout() )
            {
                wp_dequeue_script('wc-checkout');
                wp_deregister_script('wc-checkout');
                wp_enqueue_script('wc-checkout', $js_path . 'wc-checkout.min.js', ['script', 'woocommerce', 'wc-country-select', 'wc-address-i18n'], false, true);
            }
        }
    }
});


// Defer scripts, not that important since we force everything to the footer though
add_filter('script_loader_tag', function($tag, $handle)
{
    if ( !is_admin() && !strpos($tag, '/wp-includes/js/jquery/jquery') )
    {
        $tag = str_replace(' src',' defer src', $tag);
    }

    return $tag;
}, 10, 2);


// Safely handle inline JavaScript depending on jQuery:

// Create queue of jquery calls from inline scripts
/*
add_filter('wp_head', function()
{
    if ( !is_admin() )
    {
        echo '<script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>' . "\n";
    }
}, 0, 0);
*/

// Execute the queue of jquery calls from inline scripts
/*
add_action('wp_footer', function()
{
    if ( !is_admin() )
    {
        echo '<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>' . "\n";
    }
}, 30, 0);
*/
