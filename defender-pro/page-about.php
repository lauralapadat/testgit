<?php
/**
 * Template Name: About
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

?>

<section id="heading">
    <div class="ui grid">
        <div class="twelve wide centered column">
            <h1 class="ui intro-text heading">
                About us
            </h1>
            <h2 class="ui heading intro-description">
                A leader in Antivirus & Online Security for over 10 Years
            </h2>
        </div>
    </div>
</section>
<?php if ( have_rows( 'contact_about') ) : ?>
<section class="about-section about">
    <div class="ui page grid">
        <?php while ( have_rows( 'contact_about') ) : the_row(); ?>
            <div class="twelve wide centered column">
                <img class="ui centered image" src="<?php echo wp_get_attachment_image_src( get_sub_field('image'), 'full' )[0]; ?>" alt="">
                <h1 class="ui heading"><?php the_sub_field('title'); ?></h1>
                <span><?php the_sub_field('text'); ?></span>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>
<img class="contact-image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/icon-about-03.png" alt="">
<section class="about-section contact">
    <div class="ui page stackable grid">
        <div class="twelve wide segment centered column">
            <h1 class="ui heading">
                <?php the_field('contact_title'); ?>
            </h1>
            <span>
                <?php the_field('contact_description'); ?>
            </span>
        </div>
    </div>
</section>

<?php get_footer(); ?>
