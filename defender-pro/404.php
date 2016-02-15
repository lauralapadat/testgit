<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<section id="heading">
    <div class="ui page grid">
        <div class="column center aligned">
            <h1 class="ui heading intro-text">
                Oops! The page you're looking for cannot be found.
            </h1>
        </div>
    </div>
</section>

<section id="policy">
    <div class="ui column stackable wide page grid">
            <div class="column">
                <p class="ui heading">
                    Our apologies, this page cannot be found (404 Error). This could be the result of a broken link on the page you just came from or a mistyped address or an out-of-date bookmark.
                </p>
                <p>
                    You may want to try doing one of the following:
                </p>
                <ul class="ui list">
                    <li><p>Try going <a href="/">to our homepage</a>, and find what you're looking for in there.</p></li>
                    <li><p>If you typed the page address in the Address bar, make sure that it is spelled correctly.</p></li>
                    <li><p>If it was a link from our website, click the back button in your browser to return and try another link.</p></li>
                    <li><p>And if you're really stuck, our <a href="/support">Support Team</a> is more than happy to help you!</p></li>
                </ul>
            </div>
    </div>
</section>

<?php get_footer(); ?>