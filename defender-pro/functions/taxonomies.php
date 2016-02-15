<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Taxonomies
|--------------------------------------------------------------------------
*/

function defender_taxonomies_init()
{
    // Add type field for kb_article
    register_taxonomy('kb_category', 'kb_article', [
        'hierarchical'      => true,
        'label'             => 'Categories',
        'query_var'         => true,
        'rewrite'           => [
            'slug'       => 'support/category',
            'with_front' => false
        ],
        'show_admin_column' => true
    ]);

    // Add products field for kb_article
    register_taxonomy('kb_products', ['kb_article', 'video_guide'], [
        'hierarchical'      => true,
        'label'             => 'Products',
        'query_var'         => true,
        'rewrite'           => [
            'slug'       => 'support/products',
            'with_front' => false
        ],
        'show_admin_column' => true
    ]);

    // Add versions field for kb_article
    register_taxonomy('kb_versions', 'kb_article', [
        'hierarchical'      => true,
        'label'             => 'Versions',
        'query_var'         => true,
        'rewrite'           => [
            'slug'       => 'support/version',
            'with_front' => false
        ],
        'show_admin_column' => true
    ]);

    // Add tags field for kb_article
    register_taxonomy('kb_tags', 'kb_article', [
        'hierarchical'      => false,
        'label'             => 'Tags',
        'query_var'         => true,
        'rewrite'           => [
            'slug'       => 'support/tag',
            'with_front' => false
        ],
        'show_admin_column' => true
    ]);
}
add_action('init', 'defender_taxonomies_init');
