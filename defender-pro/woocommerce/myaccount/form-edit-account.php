<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

defender_print_page_heading(['acf_page_id' => 7]);

wc_print_notices(); ?>

<section id="edit_account">
	<div class="ui grid">
		<div class="centered row">
			<div class="six wide column">
				<form class="ui form" action="" method="post">

					<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

					<h4 class="ui top attached header"><?php _e( 'Personal Information', 'woocommerce' ); ?></h4>
					<div class="ui bottom attached segment">
						<div class="required field">
							<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?></label>
							<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
						</div>
						<div class="required field">
							<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?></label>
							<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
						</div>

						<div class="required field">
							<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?></label>
							<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
						</div>
					</div>

					<h4 class="ui top attached header"><?php _e( 'Password Change (leave blank to leave unchanged)', 'woocommerce' ); ?></h4>

					<div class="ui bottom attached segment">
						<div class="field">
							<label for="password_current"><?php _e( 'Current Password', 'woocommerce' ); ?></label>
							<input type="password" class="input-text" name="password_current" id="password_current" />
						</div>
						<div class="field">
							<label for="password_1"><?php _e( 'New Password', 'woocommerce' ); ?></label>
							<input type="password" class="input-text" name="password_1" id="password_1" />
						</div>
						<div class="field">
							<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
							<input type="password" class="input-text" name="password_2" id="password_2" />
						</div>
					</div>

					<?php do_action( 'woocommerce_edit_account_form' ); ?>

					<?php wp_nonce_field( 'save_account_details' ); ?>

					<input type="hidden" name="save_account_details" value="<?php _e( 'Save changes', 'woocommerce' ); ?>" />
					<input type="submit" class="ui submit button" name="save_account_details" value="<?php _e( 'Save changes', 'woocommerce' ); ?>" />
					<input type="hidden" name="action" value="save_account_details" />

					<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

				</form>
			</div>
		</div> <!-- row -->
	</div> <!-- grid -->
</section>
