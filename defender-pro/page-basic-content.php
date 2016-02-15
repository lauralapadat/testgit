<?php
/**
 * Template Name: Basic Text Content
 * @package WordPress
 * @subpackage Defender-Pro-Theme
 * @since Defender-Pro 0.1
 */


if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

if ( have_posts() ): while ( have_posts() ): the_post(); ?>

<section id="heading">
    <div class="ui page grid">
        <div class="column center aligned">
            <h1 class="ui heading intro-text">
                <?php the_title(); ?>
            </h1>

        </div>
    </div>
</section>

<section id="basic content">
    <div class="ui one column wide page grid">
        <?php while ( have_rows('page_content')) : the_row(); ?>
            <div class="column">
                <h2 class="ui heading">
                    <?php the_sub_field('title'); ?>
                </h2>
                <p>
                    <?php the_sub_field('description') ?>
                </p>
            </div>
        <?php endwhile; ?>
    </div>
</section>

 <?php
 endwhile; endif;
 get_footer();
 ?>

