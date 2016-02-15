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

    $display_download = get_field('has_download_button');
    $display_buy      = get_field('has_buy_button');
?>
<section id="heading">
    <div class="container ui two column centered stackable page grid left aligned">
            <div class="column">
                    <h1 class="ui heading">
                        <?php the_field('heading_title'); ?>
                    </h1>
                    <h4>Let the Medics Sanitize Your Mac</h4>
                    <div class="checklist">
                        <ul>
                            <li>
                                <i class="checkmark icon"></i>
                                <h5>Faster Mac performance &amp; quick startup time</h5>
                            </li>
                            <li>
                                <i class="checkmark icon"></i>
                                <h5>Fewer errors, crashes &amp; end random freezes</h5>
                            </li>
                            <li>
                                <i class="checkmark icon"></i>
                                <h5>Battery optimization to maximize your laptop charge</h5>
                            </li>
                            <li>
                                <i class="checkmark icon"></i>
                                <h5>Speed up Mail &amp; Web browsing</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="buttons">
                            <?php
                                    if ($display_download):
                                        defender_wc_print_download($product);
                                    endif;
                            ?>
                            <?php
                                    if ($display_buy):
                                        defender_wc_print_add_to_cart($product);
                                    endif;
                            ?>
                    </div>
            </div>
            <div class="column image-container">
                    <img class="ui image" src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/laptop.png" alt="">
            </div>
    </div>
</section>
<section class="description">
    <div class="ui centered stackable page grid">
        <div class="column ten wide">
            <h2>The best way to optimize your mac</h2>
            <h5>Have you noticed your Mac is running slower? Mac Medic is an incredibly fast and efficient disk utility to optimize your Mac!</h5>
            <h5>Mac Medic gets your Mac back in shape with quick, essential tools to increase battery life, speed up workflow, and organize files and folders. Mac Medic keeps your Mac running smoothly.</h5>
        </div>
      <div class="column six wide">
            <div id="screenshots"> <!-- class="flexslider" -->
              <img class="ui overlayable centered image" src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/slide-show-1.png" />
            </div>
        </div>
    </div>
</section>
<section class="features">
    <div class="ui two column centered stackable page grid left aligned">
        <h2>Mac Medic Features</h2>
        <div class="column">
            <div class="feature-container">
                <img src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/icons/dashboard.png" alt="">
                <p><em>Optimize</em> and repair your Mac so your OS and applications run faster, and manage apps that start up automatically when you boot your Mac.</p>
            </div>
        </div>
        <div class="column">
            <div class="feature-container">
                <img src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/icons/stack.png" alt="">
                <p><em>Reclaims disk space</em> to optimize performance.</p>
            </div>
        </div>
        <div class="column">
            <div class="feature-container">
                <img src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/icons/blink.png" alt="">
                <p><em>Free cache</em> by clearing your system of temporary files causing poor performance and stability</p>
            </div>
        </div>
        <div class="column">
            <div class="feature-container">
                <img src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/icons/video.png" alt="">
                <p><em>Better desktop experience!</em> Clean up your Desktop to speed up and run system maintenance tasks to keep your Mac running smoothly.</p>
            </div>
        </div>
        <div class="column">
            <div class="feature-container">
                <img src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/icons/battery.png" alt="">
                <p><em>Battery optimization!</em> Maximize the life of your unplugged laptop battery.</p>
            </div>
        </div>
    </div>
</section>
<section class="call-to-action">
    <div class="ui page grid stackable">
        <div class="column five wide">
            <img class="ui centered image" src="/wp-content/themes/defender-pro/assets/img/landing-pages/macmedic/box.png" alt="">
        </div>
        <div class="column ten wide center aligned">
            <h1>There is no need to wait,<br> the solution is here.</h1>
            <h3>We guarantee it.</h3>
            <?php
                    if ($display_download):
                        defender_wc_print_download($product);
                    endif;
            ?>
            <?php
                    if ($display_buy):
                        defender_wc_print_add_to_cart($product);
                    endif;
            ?>
        </div>
    </div>
</section>

