<?php
/**
 * Edit address form
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


defender_print_page_heading(['acf_page_id' => 7]);

global $current_user;

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );

get_currentuserinfo();

wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

<section id="edit_address">
	<div class="ui grid">
		<div class="centered row">
			<div class="six wide column">
				<form class="ui form" method="post">

					<h2 class="ui header"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h2>

					<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

					<?php foreach ( $address as $key => $field ) : ?>

						<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

					<?php endforeach; ?>

					<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

					<div class="field">
						<input type="hidden" name="save_address" value="<?php _e( 'Save Address', 'woocommerce' ); ?>" />
						<input type="submit" class="ui submit button" name="save_address" value="<?php _e( 'Save Address', 'woocommerce' ); ?>" />
						<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
						<input type="hidden" name="action" value="edit_address" />
					</div>
				</form>
			</div>
		</div> <!--  row -->
	</div> <!-- grid -->
</section>

<?php endif; ?>
