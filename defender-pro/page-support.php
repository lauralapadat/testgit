<?php
/**
 * Template Name:Support
 *
 * @package WordPress
 * @subpackage Defender-Pro-Theme
 * @since Defender-Pro 0.1
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
<div id="support-menu">
    <div class="ui page grid">
        <div class="column">
            <div id="support-tabs" class="ui support-tab tabular menu top attached three item">
                <div class="item active" data-tab="support"><h5><i class="ticket icon"></i>Contact Support</h5></div>
                <div class="item" data-tab="knowledgebase"><h5><i class="copy icon"></i>Knowledgebase</h5></div>
                <div class="item" data-tab="archive"><h5><i class="archive icon"></i>Archive</h5></div>
            </div>
        </div>
    </div>
</div>
<section id="support">
    <div class="ui page grid">
        <div class="column">
            <div class="ui tab bottom attached segment center aligned active" data-tab="support">
                <div class="ui grid stackable">
                    <div class="row">
                        <div class="eighteen wide column">
                            <h2 class="ui heading">
                                Submit a ticket
                            </h2>
                            <span>And our friendly staff will answers as soon as possible.</span>
                            <br>
                            <?php get_template_part( 'partials/submit-ticket' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui tab bottom attached segment center aligned" data-tab="knowledgebase">
                <div class="ui grid stackable center aligned">
                    <div class="four column row">
                        <div class="column">
                            <a href="/support/products/pc-medic">
                                <div class="support-block ui segment">
                                    <i class="doctor icon"></i>
                                    <h3 class="ui heading">PC Medic</h3>
                                </div>
                            </a>
                        </div>
                        <div class="column">
                            <a href="/support/videos/how-to-install-defender-pro/">
                                <div class="support-block ui segment">
                                    <i class="video icon"></i>
                                    <h3 class="ui heading">Installation Guide</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui tab bottom attached segment center aligned" data-tab="archive">
                <div class="ui stackable grid center aligned">
                    <div class="four column row">
                        <div class="column">
                            <a href="/support/version/2012/">
                                <div class="ui segment support-block">
                                    <i class="folder open icon"></i>
                                    <h3>2012</h3>
                                </div>
                            </a>
                        </div>
                        <div class="column">
                            <a href="/support/version/2011/">
                                <div class="ui segment support-block">
                                    <i class="folder open icon"></i>
                                    <h3>2011</h3>
                                </div>
                            </a>
                        </div>
                        <div class="column">
                            <a href="/support/version/2010/">
                                <div class="ui segment support-block">
                                    <i class="folder open icon"></i>
                                    <h3>2010</h3>
                                </div>
                            </a>
                        </div>
                        <div class="column">
                            <a href="/support/version/2009/">
                                <div class="ui segment support-block">
                                    <i class="folder open icon"></i>
                                    <h3>2009</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<?php
get_footer();
?>
