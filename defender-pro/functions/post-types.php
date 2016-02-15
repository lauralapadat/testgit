<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Post Types
|--------------------------------------------------------------------------
*/

function defender_post_types_init()
{
    // Add post type for kb articles
    register_post_type('kb_article', [
        'labels'      => [
            'name'          => __('KB Articles'),
            'singular_name' => __('KB Article')
        ],
        'menu_icon'   => 'dashicons-format-aside',
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => [
            'slug'          => 'support/articles',
            'pages'         => false,
            'feed'          => false,
            'with_front'    => false
        ],
        'taxonomies'  => ['kb_category', 'kb_products', 'kb_versions', 'kb_tags'],
        'supports'    => ['title', 'thumbnail', 'revisions']
    ]);

    // Add post type for video guides
    register_post_type('video_guide', [
        'labels'      => [
            'name'          => __('Video Guides'),
            'singular_name' => __('Video Guide')
        ],
        'menu_icon'   => 'dashicons-admin-media',
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => [
            'slug'          => 'support/videos',
            'pages'         => false,
            'feed'          => false,
            'with_front'    => false
        ],
        'taxonomies'  => ['kb_products'],
        'supports'    => ['title', 'thumbnail', 'revisions']
    ]);

}

add_action('init', 'defender_post_types_init');
