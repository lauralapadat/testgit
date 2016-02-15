<?php
/**
 * Template Name: Download
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();
$i = 0;
?>

    <section id="heading">
        <div class="ui page stackable grid">
            <div class="sixteen wide column center container">
                <h1 class="ui heading">
                    Thank you for Downloading <?php the_field('download_product_name'); ?>
                </h1>
            </div>
        </div>
    </section>
    <section class="download">
        <div class="ui page stackable grid">
            <div class="sixteen wide column center aligned">
                <h1>Your download will start automatically</h1>
                <h3>If you download does not start automatically, please click <a id="the-download-link" href="#">here</a>.</h3>
            </div>
            <div class="ui segment row instructions">
                <div class="eight wide column">
                    <ul>
                        <?php
                            if( have_rows('download_instructions') ) :
                                while( have_rows('download_instructions') ) : the_row();
                        ?>
                                <li>
                                    <img src="<?php echo wp_get_attachment_image_src( get_sub_field('icon'), 'full' )[0]; ?>" alt="">
                                    <h3><?php echo "Step " . ++$i ?></h3>
                                    <?php if ( have_rows('instructions') ) :
                                        while( have_rows('instructions') ) : the_row();
                                            echo '<p>' . get_sub_field('instruction') . '</p>';
                                        endwhile;
                                    endif; ?>
                                </li>
                        <?php
                                endwhile;
                            endif;
                        ?>
                    </ul>
                </div>
                <div class="eight wide column center aligned">
                    <img class="main-image" src="<?php echo wp_get_attachment_image_src( get_field('download_main_image'), 'full' )[0]; ?>" alt="">
                </div>
            </div>
        </div>
    </section>
<script type="text/javaScript">
    var downloadProduct = function() {
        var mac_link = "<?php the_field('download_link_mac') ?>",
            win_link = "<?php the_field('download_link') ?>";

        if ((navigator.userAgent.indexOf('Macintosh') != -1 || navigator.userAgent.indexOf('Mac_PowerPC') != -1) && mac_link != "") {
            location.href = mac_link;
        } else {
            location.href = win_link;
        }
    }

    window.setTimeout(downloadProduct, 2000);

    document.getElementById('the-download-link').onclick=downloadProduct;
</script>

<?php
get_footer();
?>
