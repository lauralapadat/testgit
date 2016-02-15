<?php
/**
 * Template Name: Landing MacCleanse
 * Description: This is a landing page For the MacCleanse Product
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
    if ( get_field('hide_buy_button') ) {
        $landingHideBuyButton = get_field('hide_buy_button');
    } else {
        $landingHideBuyButton = false;
    }
    if ( get_field('download_override') ) {
        $landingDownload = get_field('download_override');
    }

    // Here we loop into our product page data for 'Mac Cleanse', which is grabbed by 'p' => '511'.
    $args = array(
        'post_type' => 'product',
        'p' => 511
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
    <!-- We hide the nav-bar and footer from this landing page -->
    <style>
        nav#nav, footer {
            display: none;
        }
    </style>
<?php
    if ( !isset($landingDownload) ) {
        $landingDownload = get_field('download_link');
    }
    $image      = wp_get_attachment_image_src( get_field('heading_image'), 'full' )[0]; ?>
    <?php $is_promo_page = true; ?>
    <?php
    if (strpos("$_SERVER[REQUEST_URI]",'promo/maccleanse/')) {
        $is_promo_page = false;
    }
?>
    <div id="landing-page-maccleanse" class="maccleanse">
        <nav id="maccleanse-nav">
            <ui class="ui centered page stackable grid">
                <div class="column">
                    <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/logo.png" alt="">
                    <?php if ($is_promo_page) : ?>
                        <p>Call Tech Support: <em>1-855-999-9830</em>, 9am to 12am M/F, EST.</p>
                    <?php endif; ?>
                </div>
            </ui>
        </nav>
        <section class="header">
            <div class="ui two column centered stackable page grid">
                <div class="column">
                    <img class="ui centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/header-image.png" alt="">
                </div>
                <div class="column">
                    <h2>MacCleanse 5</h2>
                    <span>Version 5.03</span>
                    <p>If your Mac isn’t brand new, chances are it’s accumulated lots of junk that you can’t see.
MacCleanse 5 makes it easy to get rid of clutter that’s slowing your Mac, so you’ll have all the speed you’ll ever need.</p>
                    <div class="center aligned">
                        <a href="<?php echo $landingDownload; ?>" class="ui button white">
                            <h5>Try Now</h5>
                        </a>
                        <?php if ( !$landingHideBuyButton ) :  ?>
                            <a href="<?php echo get_field('buy_link'); ?>" class="ui button red">
                                <h5>Buy Now</h5>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="description">
            <div class="ui centered stackable page grid">
                <h2>Award Winning <em>MacCleanse 5</em></h2>
                <div class="column ten wide">
                    <h5>Defender Pro's MacCleanse 5 quickly cleans your Mac to increase speed, making it easier to use.</h5>
                    <h5>MacCleanse 5 scans every inch of your system, removes gigabytes of junk in just two clicks and monitors the health of your Mac.</h5>
                    <h5>MacCleanse 5 shows you exactly what to clean scanning everything on your Mac including iTunes, Mail, Trash and folders.</h5>
                </div>
              <div class="column six wide">
                    <div class="flexslider" id="screenshots">
                      <ul class="slides">
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-1.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-2.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-3.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-4.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-5.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-6.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-7.jpg" />
                        </li>
                        <li>
                          <img class="ui overlayable centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/slide-show-8.jpg" />
                        </li>
                      </ul>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section class="features">
            <div class="ui two column centered stackable page grid left aligned">
                <h2>Amazing <em>Features</em></h2>
                <div class="column">
                    <div class="feature-container">
                        <i class="icon rocket"></i><p><em>Speed up your Mac</em> by cleaning up unnecessary and duplicate files.</p>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-container">
                        <i class="icon computer"></i><p><em>Reclaims disk space</em> to optimize performance.</p>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-container">
                        <i class="icon trash"></i><p><em>Get rid of duplicates</em> you will never need.</p>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-container">
                        <i class="icon disk cubes"></i><p><em>Simply and elegantly</em> organize your desktop, dock and files to make it easier to use.</p>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-container">
                        <i class="icon folder open"></i><p><em>Help create smart folders</em> to quickly access files you use most.</p>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-container">
                        <i class="icon world"></i><p><em>Erase app & web histories,</em> cookies, caches and logs to save disk space and protect your privacy.</p>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section class="reviews">
            <div class="flexslider" id="testimonials">
                <div class="slides">
                    <div class="slide">
                        <div class="ui two column stackable page grid">
                            <div class="column">
                                <blockquote>
                                    <p>The simplest and most thorough system clean-up I've ever seen. I always dreaded doing this stuff manually, but now I don't have to. What a lifesaver MacCleanse has been - not only for my Mac's personal well-being, but for my own.</p>
                                </blockquote>
                                <div class="arrow"></div>
                                <div class="author">
                                    <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/client.png" alt="">
                                    <p>Christopher McTureen</p>
                                </div>
                            </div>
                            <div class="column">
                                <blockquote>
                                    <p>Running a Macbook Air with only 120 gigabytes of storage in it, I need every bit of it that I can preserve. MacCleanse is the prefect app to help me with keeping my storage use to a minimum and keep my Mac running smoothly. Everyone should own a copy. It's absolutely essential.</p>
                                </blockquote>
                                <div class="arrow"></div>
                                <div class="author">
                                    <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/client.png" alt="">
                                    <p>James White</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="ui two column stackable page grid">
                            <div class="column">
                                <blockquote>
                                    <p>Great app and even greater support for it - Defender listens to their customers and are always updating these apps to make them better. MacCleanse is the greatest app of its kind, and it's getting greater every day. This should be a Mac essential. Someone should seriously talk to Apple about that.</p>
                                </blockquote>
                                <div class="arrow"></div>
                                <div class="author">
                                    <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/client.png" alt="">
                                    <p>Joel Hansen</p>
                                </div>
                            </div>
                            <div class="column">
                                <blockquote>
                                    <p>Easy to use and understand. I didn't need a manual, and everything just made sense. I wasn't scared to accidentally wipe my documents and photos.</p>
                                </blockquote>
                                <div class="arrow"></div>
                                <div class="author">
                                    <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/client.png" alt="">
                                    <p>Luther Wick</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="ui two column stackable page grid">
                            <div class="column">
                                <blockquote>
                                    <p>I'll be the first to say that I don't know much about computers, but this app is so easy to use that I don't need to. It has a "safe" option for people like me that are paranoid they're going to blow up the whole entire computer just by pressing one wrong button. It does everything for me without flaw or cause for worry. Seriously, you won't be disappointed!</p>
                                </blockquote>
                                <div class="arrow"></div>
                                <div class="author">
                                    <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/client.png" alt="">
                                    <p>Nancy Fry</p>
                                </div>
                            </div>
                            <div class="column">
                                <blockquote>
                                    <p>This app is wonderful. Very simple to use but it does so much. I've recovered countless gigabytes of lost storage just by using this app and uncovering what I didn't even know I had in there. How did I ever live without this thing?</p>
                                </blockquote>
                                <div class="arrow"></div>
                                <div class="author">
                                    <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/client.png" alt="">
                                    <p>Craig Nickson</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section class="call-to-action">
            <div class="ui page grid stackable">
                <div class="column five wide">
                    <img class="ui centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/maccleanse/box.png" alt="">
                </div>
                <div class="column ten wide center aligned">
                    <h1>There is no need to wait,<br> the solution is here.</h1>
                    <?php if ($is_promo_page) : ?>
                        <h3>Need help? Call <em>1-855-999-9830</em>.</h3>
                    <?php else : ?>
                        <h3>We guarantee it.</h3>
                    <?php endif; ?>
                    <a href="<?php echo $landingDownload; ?>" class="ui button grey">
                        <h3>Try Now</h3>
                    </a>
                    <?php if ( !$landingHideBuyButton ) :  ?>
                        <a href="<?php echo get_field('buy_link'); ?>" class="ui button red">
                            <h3>Buy Now</h3>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
