<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| Widgets
|--------------------------------------------------------------------------
*/

function defender_widgets_init()
{
    register_sidebar([
        'name'          => __('Sidebar', 'defender'),
        'id'            => 'sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'defender_widgets_init');

//include '../widgets/example-widget.php';
