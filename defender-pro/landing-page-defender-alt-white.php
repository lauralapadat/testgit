<?php
/**
 * Template Name: Landing Defender Alt White
 * Description: This is an alternative Defender Pro Antivirus Landing Page for A/B testing.
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

// Here we add the 'single-product' class to the body in order to use styles that are specified for the single product template.
add_filter('body_class', function()
{
    return ['single-product'];
});

    // Here we loop into our product page data for 'Defender Pro Total', which is grabbed by 'p' => '480'.
    $args = array(
        'post_type' => 'product',
        'p' => 22
        );
    $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();

get_header();

?>
<style>
    body {
        background-color: white;
    }
    nav#nav, footer {
        display: none;
    }
</style>
<div id="defender-pro-alt-white">
    <section class="header">
        <div class="ui page short grid">
            <div class="column eight wide">
                <h2>Defender Pro Total</h2>
                <ul>
                    <li>Antivirus & Internet Security</li>
                    <li>Licensed for 3PC's for 1 Year</li>
                    <li>Real time threat detection</li>
                    <li>9-5 PST Free Support</li>
                </ul>
                <div class="buttons">
                    <a href="<?php echo get_field('buy_link'); ?>" class="ui button">
                        <h3>Get Now</h3>
                    </a>
                    <div class="guarantee">
                        <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/icon-seal-gold.png" alt="">
                        <div class="text">
                            <p>Money Back Guarantee</p>
                            <p>Buy without Risk! If you're not satisfied in the first 30 days we'll refund your money.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column eight wide">
                <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/headerart.png" alt="">
            </div>
        </div>
    </section>
    <section class="tabs">
        <div class="ui page grid">
            <div class="row tabs-menu">
                <div class="column">
                    <div class="ui pointing secondary tabular menu">
                        <a class="active item" data-tab="first">Features</a>
                        <a class="item" data-tab="second">Testimonials</a>
                        <a class="item" data-tab="third">Requirements</a>
                    </div>
                </div>
            </div>
            <div class="ui active tab segment features" data-tab="first">
                <div class="ui two column grid">
                    <div class="column">
                        <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/icon-av.png" alt="">
                        <div class="text">
                            <h5>Antivirus</h5>
                            <p>Detect and remove viruses, spyware, ransomware and other threats with our award winning antivirus technology. Surf and search safely on PC or Laptop.</p>
                        </div>
                    </div>
                    <div class="column">
                        <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/icon-firewall.png" alt="">
                        <div class="text">
                            <h5>Firewall Control Center</h5>
                            <p>The Firewall Control Center provides you with easy to use tools to ensure continuous monitoring and protection during all your online activity, providing real time threat alerts when needed.</p>
                        </div>
                    </div>
                    <div class="column">
                        <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/icon-privacy.png" alt="">
                        <div class="text">
                            <h5>Antivirus</h5>
                            <p>Protect yourself and your family from identity thieves data theft and spyware with our real time internet security scan engine. Defender Internet Security helps ensure that your online activities and browsing habits remain private, blocking hidden programs that track and steal your personal information.</p>
                        </div>
                    </div>
                    <div class="column">
                        <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/icon-multi.png" alt="">
                        <div class="text">
                            <h5>Antivirus</h5>
                            <p>Defender Pro is a great value with a 3PC/1 year license. Improve your computer's performance by up to 10x with our award winning suite of repair tools. Our deep system optimization process ensures that your PC's are always running at peak performance.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui tab segment" data-tab="second">
                <div class="ui grid">
                    <div class="column">
                        <h4>
                            "Defender Pro takes the worry away from protecting your PC and makes it easy – even for first-time computer users. Top score for user experience: 5 out of 5!"
                        </h4>
                        <p>- Maggie G.</p>
                        <h4>
                            "You can just set it, forget it and it will protect you. It is very easy to use and I'm sure it will find a home on many computers."
                        </h4>
                        <p>- Thomas J.</p>
                    </div>
                </div>
            </div>
            <div class="ui tab segment" data-tab="third">
                <div class="ui grid requirements">
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
    </section>
    <section class="call-to-action">
        <div class="ui page short grid">
            <div class="column ten wide">
                <div class="buttons">
                    <a href="<?php echo get_field('download_link'); ?>" class="ui button grey"><h3>Try Now</h3></a>
                    <a href="<?php echo get_field('buy_link'); ?>" class="ui button"><h3>Get Now</h3></a>
                    <div class="guarantee">
                        <img src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/icon-seal-gold.png" alt="">
                        <div class="text">
                            <p>Money Back Guarantee</p>
                            <p>Buy without Risk! If you're not satisfied in the first 30 days we'll refund your money.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column six wide">
                <img class="ui centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/box-av.png" alt="">
            </div>
        </div>
    </section>
    <section class="awards">
        <div class="ui page grid">
            <div class="nine wide column">
                <ui class="ui six column grid">
                    <div class="column">
                        <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/award-icsa.png" alt="ICSA Labs Award">
                    </div>
                    <div class="column">
                        <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/award-bb.png" alt="Best Biz Award">
                    </div>
                    <div class="column">
                        <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/award-checkmark.png" alt="Checkmark Award">
                    </div>
                    <div class="column">
                        <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/award-inco.png" alt="Inco Award">
                    </div>
                    <div class="column">
                        <img class="ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/landing-pages/defender-pro-alt-white/award-vb.png" alt="VB Award">
                    </div>
                </ui>
            </div>
            <div class="seven wide column">
                <p>Defender Pro takes the worry away from protecting your PC and makes it easy - even for first-time computer users. Top score for user experience: 5 out out 5!</p>
                <p>* If you're not happy for any reason we'll give you a full refund no questions asked.</p>
            </div>
        </div>
    </section>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
