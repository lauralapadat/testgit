<?php
/**
 * @package WordPress
 * @subpackage 123CopyDVD-Theme
 * @since 123CopyDVD 0.1
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();

?>
<section id="heading">
    <div class="ui grid">
        <div class="twelve wide column centered center aligned">
            <h1 class="intro-text ui heading">
                Need Help?  Contact Us Free 9-5 PST.
            </h1>
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
                <div class="active section"><?php echo get_queried_object()->name; ?></div>
            </div>
            <div class="return">
                <a href="javascript:history.back(1)">Go Back</a>
                <i class="reply icon"></i>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="ui page grid">
        <div class="sixteen wide column">

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="ui segment">
                    <h2 class="ui header">
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                    </h2>


                    <?php
                    $terms = get_the_terms( $post->ID , 'kb_category' );
                    foreach ($terms as $term) {
                        echo '<a href=" ' . get_term_link( $term, 'kb_products' ) . ' " class="ui label">' .$term->name . '</a>';
                    }
                    ?>


                    <?php if( have_rows('article_content') ):

                        while ( have_rows('article_content') ) : the_row();

                            if ( get_row_layout() == 'general_content' ): ?>

                                <p><?php the_sub_field('content'); ?></p>

                            <?php endif;

                    endwhile;

                    else :

                        // no layouts found

                    endif;  ?>
                    </div> <!-- segment -->

                <?php endwhile; ?>

                <?php wp_pagenavi(); ?>

            <?php else: ?>

                <h2>Nothing Found</h2>

            <?php endif; ?>
        </div>
    </div>

</section>
<?php get_footer(); ?>
