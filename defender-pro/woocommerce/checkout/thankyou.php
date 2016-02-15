<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

defender_print_page_heading(['acf_page_id' => 6]);

wc_print_notices(); ?>

<?php if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<?php
			$message  = '<a class="ui right floated button wc-backward" href="'. esc_url( $order->get_checkout_payment_url() ) .'">'. __( 'Retry', 'woocommerce' ) .'</a>';

			if ( is_user_logged_in() ):
				$message .= '<a class="ui right floated button wc-backward" href="'. esc_url( wc_get_page_permalink('myaccount') ) .'">'. __( 'My Account', 'woocommerce' ) .'</a>';
			endif;

			$message .= '<p>'. __('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce') .'</p>';

			if ( is_user_logged_in() ):
				$message .= '<p>'. __('Please attempt your purchase again or go to your account page.', 'woocommerce') .'</p>';
			else:
				$message .= '<p>'. __('Please attempt your purchase again.', 'woocommerce') .'</p>';
			endif;

			wc_print_notice($message, 'error');
		?>

	<?php else : ?>

		<?php
			if ( $order->has_status('processing') ):
				$message = '<p>'. apply_filters('woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received and is processing. You will receive an email with your license keys and downloads once processed.', 'woocommerce'), $order ) .'</p>';
			else:
				$message = '<p>'. apply_filters('woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received and completed. You will also receive an email with your license keys and downloads for your records.', 'woocommerce'), $order ) .'</p>';
			endif;
		?>

		<?php wc_print_notice($message, 'success'); ?>

		<section id="wc-thankyou">
		    <div class="ui page grid">
				<div class="one column row">
					<div class="column">

						<div class="ui small two steps">
							<div class="completed step">
								<i class="payment icon"></i>
								<div class="content">
									<div class="title">Place Order</div>
									<div class="description">Enter billing information and review your order</div>
								</div>
							</div>
							<div class="active step">
								<i class="info icon"></i>
								<div class="content">
									<div class="title">Order Complete</div>
									<div class="description">Your order receipt, license keys and downloads</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="one column row">
					<div class="column">

						<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
						<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

					</div>
				</div>
				<div class="one column row">
					<div class="column">
						<p>Bling Software Corporation, Azuero Business Center, Suite 541, Avenida Perez Chitre, Panama, 00395, Republica de Panama</p>
					</div>
				</div>
			</div>
		</section>

	<?php endif; ?>

<?php else : ?>

	<?php
		$message = '<p>'. apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ) .'</p>';
		wc_print_notice($message, 'success');
	?>

<?php endif; ?>
