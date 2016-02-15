<?php
/**
 * Template Name: GameFuel Driver Control Landing Page
 * Description: A minimal info page on Driver Control to redirect links to
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

?>
<section id="heading" class="gamefuel">
    <div class="ui page grid">
        <div class="sixteen wide centered column">
            <img src="<?php echo content_url(); ?>/themes/defender-pro/assets/img/gamefuel-logo.png" alt="GameFuel">
            <h2 class="ui heading intro-description">
                Fuel your gaming experience
            </h2>
        </div>
    </div>
</section>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="gamefuel content">
    <div class="ui page grid">
        <div class="two column wide row">
            <div class="column">
                <img src="<?php echo content_url(); ?>/themes/defender-pro/assets/img/gamefuel-laptop.png" alt="GameFuel">
            </div>
            <div class="column">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php endwhile; endif; ?>


<?php get_footer(); ?>
