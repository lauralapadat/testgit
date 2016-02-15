<?php
/**
 * @package WordPress
 * @subpackage 123CopyDVD-Theme
 * @since 123CopyDVD 0.1
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

?>

<section id="heading" class="support">
    <div class="ui grid">
        <div class="twelve wide column centered center aligned">
            <h3 class="ui heading">
                Need Help?  Contact Us Free 9-5 PST.
            </h3>
            <h1 class="ui heading">
                <i class="call icon"></i>1-877-887-3427
            </h1>
        </div>
    </div>
</section>
<section id="video-guide">

    <div class="ui one column page grid">
        <div class="column">
            <div class="ui large breadcrumb">
                <a href="<?php echo get_home_url(); ?>" class="section">Home</a>
                <i class="right chevron icon divider"></i>
                <a href="/support" class="section">Support</a>
                <!-- <i class="right chevron icon divider"></i>
                <a href="<?php echo get_post_type_archive_link( 'video_guide' ); ?>" class="section">Video Guides</a> -->
                <i class="right chevron icon divider"></i>
                <div class="active section"><?php echo get_the_title(); ?></div>
            </div>
        </div>
        <div class="twelve wide column centered center aligned">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="ui segment">
                        <div class="embed-container">
                            <?php the_field('video_embed'); ?>
                        </div>
                        <h3 class="ui header">
                            <?php echo get_the_title(); ?>
                        </h3>
                        <p><?php echo the_field('video_description'); ?></p>
                    </div> <!-- segment -->
                <?php endwhile; ?>

            <?php else: ?>

                <h2>Nothing Found</h2>

            <?php endif; ?>
        </div>
    </div>

</section>

<?php get_footer(); ?>
