<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' );

?>

<section id="heading">
    <div class="ui grid">
        <div class="twelve wide column centered center aligned">
            <h1 class="intro-text ui heading">
                Get the products you need.
            </h1>
        </div>
    </div>
</section>
<div id="product-menu">
    <div class="ui page grid">
        <div class="column">
            <div class="ui support-tab tabular menu top attached three item">
                <div class="item active" data-tab="antivirus"><h4><i class="protect icon"></i>Antivirus</h4></div>
                <div class="item" data-tab="backup"><h4><i class="cloud icon"></i>Secure Backup</h4></div>
                <div class="item" data-tab="computer-performance"><h4><i class="dashboard icon"></i>Computer Performance</h4></div>
            </div>
        </div>
    </div>
</div>

<section id="products">
    <?php
        /**
         * woocommerce_before_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action( 'woocommerce_before_main_content' );
    ?>

    <?php do_action( 'woocommerce_archive_description' ); ?>

    <?php if ( have_posts() ) : ?>
        <?php $i = 0; $terms = get_terms( 'product_cat' );
        foreach ($terms as $term) : $i++; // cycle over available terms ?>

            <div class="ui tab <?php if ($i == 1) echo 'active'; ?>" data-tab="<?php echo $term->slug; ?>">

                <?php while ( have_posts() ) : the_post(); // cycle over available products ?>

                    <?php $the_product_terms = wp_get_post_terms($post->ID, 'product_cat', array("fields" => "slugs")); ?>

                        <?php if ( in_array($term->slug, $the_product_terms) ) : // display only products that belong to this term ?>
                            <?php
                                $display_download = get_field('has_download_button');
                                $display_buy      = get_field('has_buy_button');
                            ?>
                            <article class="ui">
                                <div class="ui page stackable grid">
                                    <div class="two column row">
                                        <div class="eight wide column">
                                            <div href="#" class="wrapper">
                                                <h2>
                                                    <?php the_title(); ?>
                                                </h2>
                                                <?php the_excerpt();  ?>
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
                                                <a class="ui grey button" href="<?php the_permalink(); ?>">Learn More <i class="icon chevron right"></i></a>
                                            </div>
                                        </div>
                                        <div class="ui eight wide column center aligned">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo wp_get_attachment_image_src( get_field('heading_image'), 'full' )[0]; ?>" alt="">
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </article>

                    <?php endif; ?>

                <?php endwhile; // end of the loop. ?>

            </div>

            <?php
                /**
                 * woocommerce_after_shop_loop hook
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php endforeach; ?>

    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

        <?php wc_get_template( 'loop/no-products-found.php' ); ?>

    <?php endif; ?>

    <?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

    <?php
        /**
         * woocommerce_sidebar hook
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );
    ?>
</section>

<?php get_footer( 'shop' ); ?>
