<?php
/**
 * @package WordPress
 * @subpackage 123CopyDVD-Theme
 * @since 123CopyDVD 0.1
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
<section class="support-breadcrumb">
    <div class="ui page grid">
        <div class="sixteen wide column">
            <div class="ui large breadcrumb">
                <a href="<?php echo get_home_url(); ?>" class="section">Home</a>
                <i class="right chevron icon divider"></i>
                <a href="/support" class="section">Support</a>
                <i class="right chevron icon divider"></i>
                <a href="/support/#/knowledgebase" class="section">Knowledgebase</a>
                <i class="right chevron icon divider"></i>
                <?php $terms = get_the_terms( $post->ID , 'kb_products' );
                if ( $terms) {
                    foreach ($terms as $term) {
                        echo '<a href=" ' . get_term_link( $term, 'kb_products' ) . ' " class="ui label">' .$term->name . '</a>';
                    }
                }
                $terms = get_the_terms( $post->ID , 'kb_category' );
                if ( $terms ) {
                    foreach ($terms as $term) {
                        echo '<a href=" ' . get_term_link( $term, 'kb_products' ) . ' "class="ui label">' .$term->name . '</a>';
                    }

                }
                ?>
                <i class="right chevron icon divider"></i>
                <div class="active section"><?php single_post_title(); ?></div>
            </div>
            <div class="return">
                <a href="javascript:history.back(1)">Go Back</a>
                <i class="reply icon"></i>
            </div>
        </div>
    </div>
</section>
<section id="kb-single">

    <div class="ui page grid">
        <div class="column ui segment">

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>


                    <h1 class="ui header centered">
                        <?php echo get_the_title(); ?>
                    </h1>
                    <div class="ui divider"></div>

                    <?php if( have_rows('article_content') ):

                        while ( have_rows('article_content') ) : the_row();

                            if ( get_row_layout() == 'section_heading' ): ?>

                                <div class="ui">
                                <?php the_sub_field('content'); ?>
                                </div>

                            <?php endif;

                            if( get_row_layout() == 'instructions_list' ):

                                if ( have_rows('steps') ):

                                    while ( have_rows('steps') ) : the_row(); ?>
                                        <div class="ui">
                                        <p><?php the_sub_field('text'); ?></p>
                                        <div class="ui divider"></div>
                                        <?php
                                        if ( !empty(get_sub_field('image')) ):
                                            $image = wp_get_attachment_image_src( get_sub_field('image'), 'full' )[0];
                                            echo '<img src="' . $image . '" alt="example image" />';
                                        endif;?>
                                        </div>
                                    <?php endwhile;

                                endif;

                            endif;

                        endwhile;

                    else :

                        // no layouts found

                    endif;  ?>

                <?php endwhile; ?>

                <?php wp_pagenavi(); ?>

            <?php else: ?>

                <h2>Nothing Found</h2>

            <?php endif; ?>

        </div>
    </div>

</section>
<?php get_footer(); ?>
