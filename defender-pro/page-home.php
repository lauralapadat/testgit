<?php
/**
 * Template Name: Home
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

if ( have_posts() ): while ( have_posts() ): the_post(); ?>
    <section id="heading" class="product-family">
        <div class="ui page grid center aligned">
            <div class="row">
                <div class="sixteen wide column">
                    <h1 class="ui heading">The Defender Pro Family</h1>
                </div>
            </div>
            <div class="row four column wide">
                <div class="column">
                    <a href="/products/defender-pro-total">
                        <span>Defender Pro</span>
                        <h3>Total</h3>
                        <img class="defender-pro-family-thumb" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/box-dp-classic-right.png" alt="">
                    </a>
                    <br>
                    <a href="/products/defender-pro-total/" class="ui button white">
                        <h5 class="ui heading">Try Now</h5>
                    </a>
                    <a href="/products/defender-pro-total/?add-to-cart=22" class="ui button">
                       <p>Buy Now</p>
                    </a>
                </div>
                <div class="column">
                    <a href="/products/defender-pro-ultimate">
                        <span>Defender Pro</span>
                        <h3>Ultimate</h3>
                        <img class="defender-pro-family-thumb" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/box-dp-ultimate-right.png" alt="">
                    </a>
                    <br>
                    <a href="/products/defender-pro-ultimate/" class="ui button white">
                        <h5 class="ui heading">Try Now</h5>
                    </a>
                    <a href="/products/defender-pro-ultimate/?add-to-cart=8" class="ui button">
                       <p>Buy Now</p>
                    </a>
                </div>
                <div class="column">
                    <a href="/products/backup-vault">
                        <span>Defender Pro</span>
                        <h3>Backup Vault</h3>
                        <img class="defender-pro-family-thumb" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/box-dp-vault-right.png" alt="">
                    </a>
                    <br>
                    <a href="/products/backup-vault/" class="ui button white">
                        <h5 class="ui heading">Try Now</h5>
                    </a>
                    <a href="/products/backup-vault/?add-to-cart=23" class="ui button">
                       <p>Buy Now</p>
                    </a>
                </div>
                <div class="column">
                    <a href="/products/pc-medic">
                        <span>Defender Pro</span>
                        <h3>PC Medic&#8482;</h3>
                        <img class="defender-pro-family-thumb" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/box-dp-medic-right.png" alt="">
                    </a>
                    <br>
                    <a href="/products/pc-medic/" class="ui button white">
                        <h5 class="ui heading">Try Now</h5>
                    </a>
                    <a href="/products/pc-medic/?add-to-cart=24" class="ui button">
                       <p>Buy Now</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="front-page-video">
        <div class="ui page stackable grid">
            <div class="eight wide column center container">
                <div class="embed-container">
                  <div class="sound-banner">Click to enable sound</div>
                  <div id="clickable-wrapper"></div>
                  <div id="player"></div>
                  <span id="ytid" data-link="BbWBcuClIy0"></span>
                </div>
                <img class="ui image shadow" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/shadow-uvideo.png" alt="">
            </div>
            <div class="eight wide column center aligned container">
                <h2>Surf, Shop and Bank with Complete Peace of Mind.</h2>
                <a href="/products" class="ui button">
                    <h3>Shop Now</h3>
                </a>
            </div>
        </div>
    </section>
    <section id="choice">
        <div class="ui page stackable grid center aligned">
            <div class="row">
                <div class="sixteen wide column">
                    <h1>Get the protection that is right for you</h1>
                </div>
            </div>
            <div class="row">
                <div class="ui page grid options">
                    <div class="eight wide column">
                        <a href="products/defender-pro-ultimate" class="ui button">
                            <h5>Home</h5>
                        </a>
                        <p>Block viruses, spyware, ransomware and all major threats to your security. Surf and search safely on all your PC's and Laptops.</p>
                    </div>
                    <div class="eight wide column">
                        <a href="//defendercare.com" class="ui button dark">
                            <h5>Business</h5>
                        </a>
                        <p>Defender Care is your own 'virtual' world class IT department. 24 hours a day, 7 days a week, 365 days a year at home, in the office or on the road.</p>
                    </div>
                </div>
            </div>
                <div class="sixteen wide column">
                    <p>Not sure where to start? Call one of our dedicated support agents who will find the best solution for you.</p>
                    <h5>Call Toll Free 9-5 PST 1-877-887-3427</h5>
                </div>
            </div>
        </div>
    </section>
<!--     <section id="protect">
        <div class="ui page stackable grid center aligned">
            <div class="protect-protect-yourself row">
                <div class="five wide column">
                    <img class="sad ui image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/sad.png" alt="">
                </div>
                <div class="protect-description eleven wide column">
                    <h1 class="ui heading">Protect yourself</h1>
                    <h5>Today cyber-crime is the biggest source of illegal activity on the world. Thousands of people are being taken advantage of every day through identity-theft, financial theft, blackmail and their machines are even forced to perform illegal activities!
                    Don't be a victim and let us take care of protecting you. Let us show you how.</h5>
                </div>
            </div>
    </section> -->


<?php
endwhile; endif;
get_footer();
?>
