<?php
/**
* @package WordPress
* @subpackage Defender-Pro-Theme
* @since Defender-Pro 0.1
*/

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header(); ?>
    
    <div class="ui page grid">
        <div class="column">
            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; ?>

                <?php wp_pagenavi(); ?>

            <?php else: ?>

                <h2>Nothing Found</h2>

            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>
