<?php
/**
 * Template Name: Peace-of-mind
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

?>
<section id="heading">
    <div class="ui page grid">
        <div class="column center aligned">
            <h1 class="ui heading intro-text">
                Peace of Mind
            </h1>
            <h2 class="ui heading intro-description">
                The Defender Pro 100% Guarantee
            </h2>
        </div>
    </div>
</section>

<section id="policy">
    <div class="ui two column wide page grid">
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

<?php get_footer(); ?>
