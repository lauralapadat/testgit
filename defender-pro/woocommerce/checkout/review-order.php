<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="ui basic segment woocommerce-checkout-review-order-table">
	<h3 class="ui header" id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
	<table class="ui very basic table shop_table">
		<thead>
			<tr>
				<th class="one wide product-thumbnail"></th>
				<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="two wide product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
				<th class="three wide product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="two wide product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('cart_thumbnail'), $cart_item, $cart_item_key );

									if ( ! $_product->is_visible() )
										echo $thumbnail;
									else
										printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
								?>
							</td>

							<td class="product-name">
								<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ); ?>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							</td>

							<td class="product-price">
								<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
							</td>

							<td class="product-quantity">
								<?php echo apply_filters( 'woocommerce_cart_item_quantity', $cart_item['quantity'], $cart_item, $cart_item_key ); ?>
							</td>

							<td class="product-subtotal">
								<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>
	</table>
	<table cellspacing="0" class="ui very basic table cart_totals">
		<tr class="cart-subtotal">
			<th class="right aligned"><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<td class="two wide"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th class="right aligned"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td class="two wide"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th class="right aligned"><?php echo esc_html( $fee->name ); ?></th>
				<td class="two wide"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->tax_display_cart === 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th class="right aligned"><?php echo esc_html( $tax->label ); ?></th>
						<td class="two wide"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th class="right aligned"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td class="two wide"><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
			<th class="right aligned"><?php _e( 'Order Total', 'woocommerce' ); ?></th>
			<td class="two wide"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	</table>
</div>
