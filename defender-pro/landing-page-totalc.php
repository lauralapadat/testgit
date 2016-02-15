<?php
/**
 * Template Name: Landing Totalc
 * Description: This is a landing page brought over from the previous site. It is the same as Totalc, except that the nav bare is invisible on this version. Custom buy link: https://payments.defender-pro.com/order/checkout.php?PRODS=4631793%2c4620848&CART=1&CARD=2&ORDERSTYLE=nLWo45TPpnM=
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

// Here we add the 'single-product' class to the body in order to use styles that are specified for the single product template.
add_filter('body_class', function()
{
    return ['single-product'];
});

get_header();

?>

<?php
    // Here we loop into our product page data for 'Defender Pro Classic', which is grabbed by 'p' => '22'.
    $args = array(
        'post_type' => 'product',
        'p' => 22
        );
    $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
?>
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

<?php $image      = wp_get_attachment_image_src( get_field('heading_image'), 'full' )[0]; ?>
    <section id="heading">
        <div class="container ui two column centered stackable page grid left aligned">
            <div class="column">
                <h1 class="ui heading">
                    <?php the_title(); ?>
                </h1>
                <h4><?php echo get_field('heading_sub_title'); ?></h4>
                <div class="checklist">
                    <ul>
                        <?php while ( have_rows('heading_feature_list') ): the_row(); ?>
                            <li>                                <i class="checkmark icon"></i>
                                <h5><?php the_sub_field('feature'); ?></h5>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="buttons">
                  <a href="<?php echo get_field('download_link'); ?>">
                      <div class="ui button grey">
                          <span class="ui">Download</span>
                      </div>
                  </a>
                  <a href="https://payments.defender-pro.com/order/checkout.php?PRODS=4631793%2c4620848&CART=1&CARD=2&ORDERSTYLE=nLWo45TPpnM=">
                      <div class="ui button">
                          <span class="ui">Buy</span>
                      </div>
                  </a>
                </div>
            </div>
            <div class="column image-container">
                <img class="ui image" src="<?php echo $image; ?>" alt="">
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
                      <!-- <iframe src="https://www.youtube.com/embed/BbWBcuClIy0" frameborder="0" allowfullscreen></iframe> -->
                    </div>
                    <img class="ui image" src="http://defender-pro.com/safecart/promo/DefenderPro/images/Shadow-uvideo.png" alt="">
                </div>
                <div class="column">
                    <h3 class="ui heading">
                        <?php echo get_field('video_title'); ?>
                    </h3>
                    <h4 class="ui heading">
                        <?php echo get_field('video_text'); ?>
                    </h4>
                </div>
            </div>
    </section>
    <?php endif; ?>

    <section id="product-comparison">
        <div class="ui page centered stackable grid">
            <div class="row">
                <div class="column">
                    <h1 class="ui heading">Let's find out what's best for you:</h1>
                    <div class="ui top attached tabular menu center">
                        <a class="active item" data-tab="tab-name">Compare our Products</a>
                        <a class="item" data-tab="tab-name2">Customer Reviews</a>
                        <a class="item" data-tab="tab-name3">System Requirements</a>
                    </div>
                    <div class="ui bottom attached active tab segment center aligned" data-tab="tab-name">
                        <?php get_template_part( 'partials/antivirus-table'); ?>
                    </div>
                    <div class="ui tab customer-reviews bottom attached segment center aligned" data-tab="tab-name2">
                        <div class="ui grid stackable center aligned">

                            <?php if ( get_field('review_content') ) : ?>

                                <div class="eight wide column">
                                  <h1><em>"<?php echo get_field('review_content'); ?>"</em></h1>
                                  <h2 class="ui heading">
                                      <?php echo get_field('review_name'); ?>
                                  </h2>
                              </div>
                              <div class="eight wide column">
                                  <img src="<?php echo wp_get_attachment_image_src( get_field('review_image'), 'full' )[0]; ?>" alt="">
                              </div>

                            <?php else : ?>
                              <div class="eight wide column">
                                  <h1><em>"Defender Pro takes the worry away from protecting your PC and makes it easy – even for first-time computer users. Top score for user experience: 5 out of 5!"</em></h1>
                                  <h2 class="ui heading">
                                      Maggie G. Arkansas
                                  </h2>
                              </div>
                              <div class="eight wide column">
                                  <img class="ui centered image" src="http://localhost:3000/wp-content/themes/defender-pro/assets/img/sad.png" alt="">
                              </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="ui tab bottom attached segment center aligned" data-tab="tab-name3">
                        <div class="ui grid">
                            <?php while ( have_rows('system_requirements') ) : the_row(); ?>
                              <div class="eight wide column">
                                  <h2 class="ui heading">
                                      <?php the_sub_field('title'); ?>
                                  </h2>
                                  <span>
                                    <?php the_sub_field('description'); ?>
                                  </span>
                              </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="feature-list">
        <div class="ui page centered stackable grid">
                <?php while ( have_rows('feature_list') ) : the_row(); ?>
                    <div class="eight wide column">
                        <img class="feature-icon" src="<?php echo wp_get_attachment_image_src( get_sub_field('feature_icon'), 'full' )[0]; ?>" alt="  ">
                        <h4 class="ui heading"><?php echo get_sub_field('feature_title'); ?></h4>
                        <?php echo get_sub_field('feature_text'); ?>
                    </div>
                <?php endwhile; ?>
        </div>
    </section>

    <section id="product-help">
        <div class="ui page stackable grid">
            <div class="row center aligned">
                <div class="twelve wide centered column">
                <?php if ( get_field( 'help_title') ) : ?>
                    <h1 class="ui heading">
                        <?php echo get_field('help_title'); ?>
                    </h1>
                    <h4>
                        <?php echo get_field('help_text'); ?>
                    </h4>
                <?php else: ?>
                    <h1 class="ui heading">
                        We can help
                    </h1>
                    <h4>
                        Having a little technical trouble? Don't worry, our dedicated support is working 9-5 PST to make sure you get the smoothest Defender-Pro experience possible.
                    <br><br>
                        <em> Call us Toll Free at 1-855-855-6347.</em>
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

    </div><!-- #product-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
