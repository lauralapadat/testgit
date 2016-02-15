<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defender_print_page_heading(['acf_page_id' => 6]);

wc_print_notices(); ?>

<?php do_action('woocommerce_before_checkout_form', $checkout); ?>

<section id="wc-checkout">
    <div class="ui page grid">
		<div class="one column row">
			<div class="column">

				<div class="ui small two steps">
					<div class="active step">
						<i class="payment icon"></i>
						<div class="content">
							<div class="title">Place Order</div>
							<div class="description">Enter billing information and review your order</div>
						</div>
					</div>
					<div class="disabled step">
						<i class="info icon"></i>
						<div class="content">
							<div class="title">Order Complete</div>
							<div class="description">Your order receipt, license keys and downloads</div>
						</div>
					</div>
				</div>

			</div>
		</div>
        <div class="one column centered row">
            <div class="column">
				<?php
					// If checkout registration is disabled and not logged in, the user cannot checkout
					if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
						echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce') );
						return;
					}

					// filter hook for include new pages inside the payment method
					$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
				?>

				<form name="checkout" method="post" class="ui form checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data" autocomplete="on">

					<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

						<div id="customer_details">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>

							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

					<?php endif; ?>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

				</form>

            </div>
        </div>
		<div class="one column row">
			<div class=" column">
				<p>Defender Security Limited, Azuero Business Center, Suite 541, Avenida Perez Chitre, Panama, 00395, Republica de Panama</p>
			</div>
		</div>
    </div>
</section>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
