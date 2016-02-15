<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

defender_print_page_heading([
    'heading_title' => 'My Account' /*,
    'heading_subtitle' => sprintf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	) */
]);

wc_print_notices(); ?>

<section id="myaccount_user">
	<div class="ui page grid">
		<div class="centered row">
			<div class="column">

				<?php do_action( 'woocommerce_before_my_account' ); ?>

				<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

				<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

				<?php wc_get_template( 'myaccount/my-address.php' ); ?>

				<?php do_action( 'woocommerce_after_my_account' ); ?>

			</div>
		</div>
	</div>
</section>
