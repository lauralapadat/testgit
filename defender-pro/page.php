<?php
/**
 * @package WordPress
 * @subpackage Defender-Pro-Theme
 * @since Defender-Pro 0.1
 */
 
 if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

 get_header();

 if ( have_posts() ): while ( have_posts() ): the_post(); ?>

     <?php the_content(); ?>

 <?php
 endwhile; endif;
 get_footer();
 ?>
