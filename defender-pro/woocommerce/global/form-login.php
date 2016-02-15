<?php
/**
 * Login form
 *
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
    return;
}

?>

<div id="customer_login" class="ui small modal">
    <i class="close icon"></i>
    <div class="header"><?php _e( 'Login', 'woocommerce' ); ?></div>
	<div class="content">
        <?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

        <form method="post" class="ui form login" >
            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <div class="required field">
                <label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?></label>
                <input type="text" class="input-text" name="username" id="username" />
            </div>
            <div class="required field">
                <label for="password"><?php _e( 'Password', 'woocommerce' ); ?></label>
                <input class="input-text" type="password" name="password" id="password" />
            </div>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <div class="inline field">
                <div class="ui checkbox">
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <label for="rememberme"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
                </div>
            </div>

            <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
            <input type="hidden" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
            <input type="submit" class="ui right floated button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />

            <p class="lost_password">
                <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
            </p>

            <?php do_action( 'woocommerce_login_form_end' ); ?>

        </form>
	</div>
</div>
