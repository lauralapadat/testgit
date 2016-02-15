<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$order = wc_get_order( $order_id );

?>

<h3 class="ui header"><?php _e( 'Order Details', 'woocommerce' ); ?></h3>

<div class="ui stackable grid">
	<div class="two column row">
		<div class="column">

			<div class="ui list order_details">
				<div class="item">
					<div class="header"><?php _e( 'Order Number:', 'woocommerce' ); ?></div>
					<?php echo $order->get_order_number(); ?>
				</div>
				<div class="item">
					<div class="header"><?php _e( 'Date:', 'woocommerce' ); ?></div>
					<?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>
				</div>
				<div class="item">
					<div class="header"><?php _e( 'Total:', 'woocommerce' ); ?></div>
					<?php echo $order->get_formatted_order_total(); ?>
				</div>
				<?php if ( $order->payment_method_title ) : ?>
					<div class="item">
						<div class="header"><?php _e( 'Payment Method:', 'woocommerce' ); ?></div>
						<?php echo $order->payment_method_title; ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
		<div class="column">

			<div class="ui list customer_details">
				<?php if ( $order->billing_email ): ?>
					<div class="item">
						<div class="header"><?php _e( 'Email:', 'woocommerce' ); ?></div>
						<?php echo $order->billing_email; ?>
					</div>
				<?php endif; ?>

				<?php if ( $order->billing_phone ): ?>
					<div class="item">
						<div class="header"><?php _e( 'Telephone:', 'woocommerce' ); ?></div>
						<?php echo $order->billing_phone; ?>
					</div>
				<?php endif; ?>

				<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

				<div class="item">
					<div class="header"><?php _e( 'Billing Address:', 'woocommerce' ); ?></div>
					<?php
						if ( ! $order->get_formatted_billing_address() ) {
							_e( 'N/A', 'woocommerce' );
						} else {
							echo $order->get_formatted_billing_address();
						}
					?>

					<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>
						<div class="header"><?php _e( 'Shipping Address:', 'woocommerce' ); ?></div>
						<?php
							if ( ! $order->get_formatted_shipping_address() ) {
								_e( 'N/A', 'woocommerce' );
							} else {
								echo $order->get_formatted_shipping_address();
							}
						?>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
	<div class="one column row">
		<div class="column">

			<table class="ui very basic table shop_table">
				<thead>
					<tr>
						<th class="one wide product-thumbnail"></th>
						<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
						<!--<th class="two wide product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>-->
						<th class="three wide product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
						<th class="two wide product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ( sizeof( $order->get_items() ) > 0 ) {

						foreach( $order->get_items() as $item_id => $item ) {
							$_product  = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
							$item_meta = new WC_Order_Item_Meta( $item['item_meta'], $_product );

							if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
									<td class="product-thumbnail">
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('cart_thumbnail'), $item, $item_id );

											if ( ! $_product->is_visible() )
												echo $thumbnail;
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink( $item_id ), $thumbnail );
										?>
									</td>
									<td class="product-name">
										<?php
											if ( $_product && ! $_product->is_visible() ) {
												echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
											} else {
												echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
											}

											// Allow other plugins to add additional product information here
											do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

											$order->display_item_meta( $item );
											$order->display_item_downloads( $item );

											// Allow other plugins to add additional product information here
											do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
										?>
									</td>
									<!--
									<td class="product-price">
										<?php echo apply_filters( 'woocommerce_order_item_price', $_product->price, $item, $item_id ); ?>
									</td>
									-->
									<td class="product-quantity">
										<?php echo apply_filters( 'woocommerce_order_item_quantity', $item['qty'], $item, $item_id ); ?>
									</td>
									<td class="product-subtotal">
										<?php echo $order->get_formatted_line_subtotal( $item ); ?>
									</td>
								</tr>
								<?php
							}

							if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
								?>
								<tr class="product-purchase-note">
									<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
								</tr>
								<?php
							}
						}
					}

					do_action( 'woocommerce_order_items_table', $order );
					?>
				</tbody>
			</table>
			<table cellspacing="0" class="ui very basic table cart_totals">
				<?php
				$has_refund = false;

				if ( $total_refunded = $order->get_total_refunded() ) {
					$has_refund = true;
				}

				if ( $totals = $order->get_order_item_totals() ) {
					foreach ( $totals as $key => $total ) {
						$value = $total['value'];

						// Check for refund
						if ( $has_refund && $key === 'order_total' ) {
							$refunded_tax_del = '';
							$refunded_tax_ins = '';

							// Tax for inclusive prices
							if ( wc_tax_enabled() && 'incl' == $order->tax_display_cart ) {

								$tax_del_array = array();
								$tax_ins_array = array();

								if ( 'itemized' == get_option( 'woocommerce_tax_total_display' ) ) {

									foreach ( $order->get_tax_totals() as $code => $tax ) {
										$tax_del_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
										$tax_ins_array[] = sprintf( '%s %s', wc_price( $tax->amount - $order->get_total_tax_refunded_by_rate_id( $tax->rate_id ), array( 'currency' => $order->get_order_currency() ) ), $tax->label );
									}

								} else {
									$tax_del_array[] = sprintf( '%s %s', wc_price( $order->get_total_tax(), array( 'currency' => $order->get_order_currency() ) ), WC()->countries->tax_or_vat() );
									$tax_ins_array[] = sprintf( '%s %s', wc_price( $order->get_total_tax() - $order->get_total_tax_refunded(), array( 'currency' => $order->get_order_currency() ) ), WC()->countries->tax_or_vat() );
								}

								if ( ! empty( $tax_del_array ) ) {
									$refunded_tax_del .= ' ' . sprintf( __( '(Includes %s)', 'woocommerce' ), implode( ', ', $tax_del_array ) );
								}

								if ( ! empty( $tax_ins_array ) ) {
									$refunded_tax_ins .= ' ' . sprintf( __( '(Includes %s)', 'woocommerce' ), implode( ', ', $tax_ins_array ) );
								}
							}

							$value = '<del>' . strip_tags( $order->get_formatted_order_total() ) . $refunded_tax_del . '</del> <ins>' . wc_price( $order->get_total() - $total_refunded, array( 'currency' => $order->get_order_currency() ) ) . $refunded_tax_ins . '</ins>';
						}
						?>
						<tr>
							<th class="right aligned" scope="row"><?php echo $total['label']; ?></th>
							<td class="two wide"><?php echo $value; ?></td>
						</tr>
						<?php
					}
				}

				// Check for refund
				if ( $has_refund ) { ?>
					<tr>
						<th class="right aligned" scope="row"><?php _e( 'Refunded:', 'woocommerce' ); ?></th>
						<td>-<?php echo wc_price( $total_refunded, array( 'currency' => $order->get_order_currency() ) ); ?></td>
					</tr>
				<?php
				}

				// Check for customer note
				if ( '' != $order->customer_note ) { ?>
					<tr>
						<th scope="row"><?php _e( 'Note:', 'woocommerce' ); ?></th>
						<td><?php echo wptexturize( $order->customer_note ); ?></td>
					</tr>
				<?php } ?>
			</table>

			<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
		</div>
	</div>
</div>
