<?php
/**
 * Template Name: (un)installing message
 * Page to show after installation is complete
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();
?>

    <section id="heading" class="welcome-heading">
        <div class="ui page stackable grid">
            <div class="sixteen wide column center container">

            </div>
        </div>
    </section>
    <section class="welcome">
        <div class="ui stackable grid center aligned">
            <div class="column sixteen wide message">
                <h1 class="ui header">
                    <?php the_field('message_header') ?>
                </h1>
                <h2 class="ui sub header"> <?php the_field('message_subheader') ?></h2>
            </div>
            <div class="column sixteen wide banner">
                <h2>FED UP WITH YOUR SLOW PC?</h2>
            </div>
            <div class="row cta">
                <div class="ui page grid">
                    <div class="six wide column">
                        <img class="ui box centered image" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/box-dp-medic-right.png" alt="">
                    </div>
                    <div class="ten wide center aligned column">
                        <h1>Discover and fix what's behind the slowdown!</h1>
                        <ul>
                            <li><i class="icon check"></i>Check your PC for errors and remove junk files</li>
                            <li><i class="icon check"></i>Optimize your hard drive for maximum performance</li>
                            <li><i class="icon check"></i>Increase Internet speed and keep your PC secure</li>
                        </ul>
                        <a href="/download/pc-medic" class="ui button">
                            <h2>RUN FREE SCAN</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
?>
