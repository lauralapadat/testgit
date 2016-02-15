<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

defender_print_page_heading([
	'heading_title'    => 'Login to My Account',
	'heading_subtitle' => 'Login to access your account where you can view your downloads, order history and licenses.'
]);

wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<section id="customer_login">
	<div class="ui page grid">

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

		<div class="two column equal height divided centered row">

<?php else: ?>

		<div class="centered row">

<?php endif; ?>

			<div class="seven wide column">

				<h2 class="ui header"><?php _e( 'Login', 'woocommerce' ); ?></h2>

				<form method="post" class="ui form login">
					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<div class="required field">
						<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?></label>
						<input type="text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</div>
					<div class="required field">
						<label for="password"><?php _e( 'Password', 'woocommerce' ); ?></label>
						<input type="password" name="password" id="password" />
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="inline field">
						<div class="ui checkbox">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<label for="rememberme"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
						</div>
					</div>

					<?php wp_nonce_field( 'woocommerce-login' ); ?>

					<input type="hidden" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
					<input type="submit" class="ui right floated button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />

					<p class="lost_password">
						<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
					</p>

					<?php do_action( 'woocommerce_login_form_end' ); ?>
				</form>
			</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

			<div class="seven wide column">
				<h2 class="ui header"><?php _e( 'Register', 'woocommerce' ); ?></h2>

				<form method="post" class="ui form register">
					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

						<div class="required field">
							<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?></label>
							<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
						</div>

					<?php endif; ?>

					<div class="required field">
						<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?></label>
						<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
					</div>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

						<div class="required field">
							<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?></label>
							<input type="password" class="input-text" name="password" id="reg_password" />
						</div>

					<?php endif; ?>

					<!-- Spam Trap -->
					<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

					<?php do_action( 'woocommerce_register_form' ); ?>
					<?php do_action( 'register_form' ); ?>

					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="ui submit button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />

					<?php do_action( 'woocommerce_register_form_end' ); ?>
				</form>
			</div>

<?php endif; ?>

		</div>
	</div>
</section>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
