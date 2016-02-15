<?php
/**
 * Template Name: Backup Vault Status Page
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

$livedrive_url = 'http://status.livedrive.com/';
$client = new Client(['base_uri' => $livedrive_url]);

$response = $client->get('/');
$body = (string) $response->getBody();

get_header();

if ( have_posts() ): while ( have_posts() ): the_post(); ?>

</div>
<section id="heading">
    <div class="ui page grid">
        <div class="column center aligned">
            <h1 class="ui heading intro-text">
                <?php the_title(); ?>
            </h1>
        </div>
    </div>
</section>
<section id="backup-vault-status" class="basic content">
    <div class="ui page grid">
            <div class="twelve wide centered column">
                <h3 class="ui heading">
                    Server Status: <span class="status"></span>
                </h3>
                <p>
                    <span class="description"></span>
                </p>
            </div>
    </div>
    <div id="status-scrape" class="invisble" data-html="<?php echo htmlspecialchars( (string)$body ); ?>">
</section>

 <?php
 endwhile; endif;
 get_footer();
 ?>

