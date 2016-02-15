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

<?php if ( $providers ) : ?>

    <div class="wc-social-login form-row-wide">
        <p><?php echo wp_kses_post( $login_text ); ?></p>
        <div class="ui buttons">
            <?php
            foreach ( $providers as $provider ) :
                printf( '<a href="%1$s" class="ui %2$s button"><i class="%2$s icon"></i> %3$s</a> ', esc_url( $provider->get_auth_url( $return_url ) ), esc_attr( $provider->get_id() ), esc_html( $provider->get_login_button_text() ) );
            endforeach;
            ?>
        </div>
    </div>

<?php endif; ?>
