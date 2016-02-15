<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<?php
    /**
     * woocommerce_before_main_content hook
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action( 'woocommerce_before_main_content' );
?>
<?php if ( $post->post_name != 'mac-medic' ): ?>
    <?php while ( have_posts() ) : the_post(); ?>

        <?php
            /**
             * woocommerce_before_single_product hook
             *
             * @hooked wc_print_notices - 10
             */
            do_action( 'woocommerce_before_single_product' );

            if ( post_password_required() ) {
                echo get_the_password_form();
                return;
            }
        ?>

        <?php
            $image            = wp_get_attachment_image_src( get_field('heading_image'), 'full' )[0];
            $display_download = get_field('has_download_button');
            $display_buy      = get_field('has_buy_button');
        ?>

        <section id="heading">
            <div class="container ui two column centered stackable page grid left aligned">
                <div class="column">
                    <h1 class="ui heading">
                        <?php the_field('heading_title'); ?>
                    </h1>
                    <h4><?php echo get_field('heading_sub_title'); ?></h4>
                    <div class="checklist">
                        <ul>
                            <?php while ( have_rows('heading_feature_list') ): the_row(); ?>
                                <li>
                                    <i class="checkmark icon"></i>
                                    <h5><?php the_sub_field('feature'); ?></h5>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <div class="buttons">
                        <?php
                            if ($display_download):
                                defender_wc_print_download($product);
                            endif;

                            if ($display_buy):
                                defender_wc_print_add_to_cart($product);
                            endif;
                        ?>
                    </div>
                </div>
                <div class="column image-container">
                    <img class="ui image" src="<?php echo $image; ?>" alt="">
                    <div class="satisfaction-guarantee">
                        <div class="refund-policy-summary">
                            <strong>Your satisfaction is our number one priority.</strong> We stand behind all of our products with one of the best guarantees in the industry.
                            <br>
                            If within 30 days of purchase you’re dissatisfied for any reason, we will give you a full refund. <a href="/peace-of-mind" target="_blank">Learn more.</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if ( get_field ('video_title') ) : ?>

            <section id="product-video">
                <div class="ui page centered stackable grid">
                    <div class="two column row center aligned">
                        <div class="column">
                            <div class="embed-container">
                                <div class="sound-banner">Click to enable sound</div>
                                <div id="clickable-wrapper"></div>
                                <div id="player"></div>
                                <span id="ytid" data-link="<?php echo get_field('video_link'); ?>"></span>
                            </div>
                            <img class="ui shadow image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/shadow-uvideo.png" alt="">
                        </div>
                        <div class="column">
                            <div class="product-video-text-wrapper">
                                <h3 class="ui heading">
                                    <?php echo get_field('video_title'); ?>
                                </h3>
                                <h4 class="ui heading">
                                    <?php echo get_field('video_text'); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php else : ?>

            <section id="no-video-description">
                <div class="ui page stackable grid">
                    <div class="row">
                        <div class="eight wide column center aligned">
                            <img class="ui image" src="<?php echo wp_get_attachment_image_src( get_field('no_video_image'), 'full' )[0]; ?>" alt="">
                        </div>
                        <div class="protect-description eight wide column">
                            <div class="text-container">
                                <h3 class="ui heading"><?php the_field('no_video_title'); ?></h3>
                                <?php the_field('no_video_text'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif;  ?>

        <section id="product-comparison">
            <div class="ui page centered stackable grid">
                <div class="row">
                    <div class="column">
                        <h1 class="ui heading"><?php echo get_field('tab_text') ?></h1>
                        <div id="product-tabs" class="ui top attached tabular menu center">
                            <a class="active item" data-tab="tab-name">Compare our Products</a>
                            <a class="item" data-tab="tab-name2">Customer Reviews</a>
                            <a class="item" data-tab="tab-name3">System Requirements</a>
                        </div>
                        <div class="ui bottom attached active tab segment product-table center aligned" data-tab="tab-name">
                            <?php
                                if ( $post->ID == '24') {
                                    get_template_part('partials/medic-table');
                                }
                                elseif ( $post->ID == '311') {
                                    get_template_part('partials/driver-table');
                                }
                                elseif ( $post->ID == '572') {
                                    get_template_part('partials/malware-table');
                                }
                                elseif ( $post->ID == '23') {
                                    get_template_part('partials/backup-table');
                                }
                                elseif ( $post->ID == '106') {
                                    get_template_part('partials/lifetime-table');
                                }
                                else {
                                    get_template_part('partials/antivirus-table');
                                }
                            ?>
                        </div>
                        <div class="ui tab customer-reviews bottom attached segment center aligned" data-tab="tab-name2">
                            <div class="ui grid stackable center aligned">
                                <?php if ( get_field('review_content') ) : ?>
                                    <div class="eight wide column">
                                        <h1><em>"<?php echo get_field('review_content'); ?>"</em></h1>
                                        <h2 class="ui heading"><?php echo get_field('review_name'); ?></h2>
                                    </div>
                                    <div class="eight wide column">
                                        <img src="<?php echo wp_get_attachment_image_src( get_field('review_image'), 'full' )[0]; ?>" alt="">
                                    </div>
                                <?php else : ?>
                                    <div class="eight wide column">
                                        <h1><em>"Defender Pro's Software takes the worry away from protecting your PC and makes it easy – even for first-time computer users. Top score for user experience: 5 out of 5!"</em></h1>
                                        <h2 class="ui heading">Maggie G. Arkansas</h2>
                                    </div>
                                    <div class="eight wide column">
                                        <img class="ui centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/sad.png" alt="">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="ui tab bottom attached segment center aligned" data-tab="tab-name3">
                            <div class="ui grid requirements">
                                <?php while ( have_rows('system_requirements') ) : the_row(); ?>
                                    <div class="eight wide column">
                                        <h2 class="ui heading"><?php the_sub_field('title'); ?></h2>
                                        <span><?php the_sub_field('description'); ?></span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="feature-list">
            <div class="ui page stackable grid">
                <?php while ( have_rows('feature_list') ) : the_row(); ?>
                    <div class="eight wide column">
                        <img class="feature-icon" src="<?php echo wp_get_attachment_image_src( get_sub_field('feature_icon'), 'full' )[0]; ?>" alt="  ">
                        <h4 class="ui heading"><?php echo get_sub_field('feature_title'); ?></h4>
                        <?php echo get_sub_field('feature_text'); ?>
                    </div>
                <?php endwhile; ?>
                <?php if ($post->ID == 106) : ?>
                    <div class="disclaimer">*Lifetime: Refers to average PC lifetime which is defined as 5 years.</div>
                <?php endif; ?>
            </div>
        </section>

        <section id="product-help">
            <div class="ui page stackable grid">
                <div class="row center aligned">
                    <div class="twelve wide centered column">
                        <?php if ( get_field( 'help_title') ) : ?>
                            <h1><?php echo get_field('help_title'); ?></h1>
                            <h4><?php echo get_field('help_text'); ?></h4>
                        <?php else: ?>
                            <h1>
                                We can help <img class="assisting-image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/icon-callus.png" alt="">
                            </h1>
                            <h4>
                                Having a little technical trouble? Don't worry, our dedicated support is working 9-5 PST to make sure you get the smoothest <?php the_field('heading_title'); ?> experience possible.<br><br>
                                <em> Call us Toll Free at 1-877-887-3427.</em>
                            </h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
            /**
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
        ?>

    <?php endwhile; // end of the loop. ?>
<?php else: ?>
    <?php
        set_query_var('product', $product );
        get_template_part('partials/product', 'macmedic');
    ?>
<?php endif; ?>
<?php
    /**
     * woocommerce_after_main_content hook
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
?>

<?php
    /**
     * woocommerce_sidebar hook
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    do_action( 'woocommerce_sidebar' );
?>

<?php get_footer( 'shop' ); ?>
