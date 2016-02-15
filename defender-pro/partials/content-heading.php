
<?php
    $acf_page_id   = get_query_var('heading_acf_page_id') ?: $post->ID;
    $background_id = get_query_var('heading_background') ?: get_field('heading_background', $acf_page_id);
    $title         = get_query_var('heading_title')      ?: get_field('heading_title', $acf_page_id);
    $subtitle      = get_query_var('heading_subtitle')   ?: get_field('heading_subtitle', $acf_page_id);
    $background    = wp_get_attachment_image_src( $background_id, 'full' )[0];
?>

<section id="heading"<?php if ( !empty($background) ): ?> style="background-image: url(<?php echo $background; ?>)"<?php endif; ?>>
    <div class="ui page grid">
        <div class="column center aligned">
            <?php if ( !empty($title) ): ?>
                <h1 class="ui heading intro-text">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>
            <?php if ( !empty($subtitle) ): ?>
                <h2 class="ui heading intro-description">
                    <?php echo $subtitle; ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>
</section>
