<?php
/**
 * Renders login buttons for available social login providers
 *
 * @param array $providers Providers to be rendered
 * @param string $return_url Return URL
 *
 * @version 1.0
 * @since 1.0
 */
?>

<?php if ( $available_providers ) : ?>

    <div class="wc-social-login wc-social-login-link-account">
            <div class="ui buttons">
            <?php
            foreach ( $available_providers as $provider ) :
                printf( '<a href="%1$s" class="ui %2$s button"><i class="%2$s icon"></i> %3$s</a> ', esc_url( $provider->get_auth_url( $return_url ) ), esc_attr( $provider->get_id() ), esc_html( $provider->get_link_button_text() ) );
            endforeach;
            ?>
        </div>
    </div>

<?php endif; ?>
