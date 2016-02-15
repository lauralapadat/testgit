<?php
/**
 * Pay for order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defender_print_page_heading(['acf_page_id' => 6]);

?>
<section id="wc-checkout">
    <div class="ui page grid">
		<div class="one column row">
			<div class="column">

				<form id="order_review" class="ui form" method="post">

					<section class="ui basic segment woocommerce-checkout-review-order-table">
						<h3 class="ui header" id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
						<table class="ui very basic table shop_table">
							<thead>
								<tr>
									<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
									<th class="three wide product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
									<th class="two wide product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ( sizeof( $order->get_items() ) > 0 ) :
									foreach ( $order->get_items() as $item ) :
										echo '
											<tr>
												<td class="product-name">' . $item['name'].'</td>
												<td class="product-quantity">' . $item['qty'].'</td>
												<td class="product-subtotal">' . $order->get_formatted_line_subtotal( $item ) . '</td>
											</tr>';
									endforeach;
								endif;
								?>
							</tbody>
						</table>
						<table cellspacing="0" class="ui very basic table cart_totals">
							<?php
								if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
									?>
									<tr class="order-total">
										<th class="right aligned"><?php echo $total['label']; ?></th>
										<td class="two wide"><?php echo $total['value']; ?></td>
									</tr>
									<?php
								endforeach;
							?>
							</tfoot>
						</table>
					</section>

					<section id="payment" class="ui basic segment woocommerce-checkout-payment">
						<h3 class="ui header"><?php _e( 'Payment', 'woocommerce' ); ?></h3>

						<?php if ( $order->needs_payment() ) : ?>
							<div class="grouped fields payment_methods methods">
								<?php
									if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
										// Chosen Method
										if ( sizeof( $available_gateways ) ) {
											current( $available_gateways )->set_current();
										}

										foreach ( $available_gateways as $gateway ) {
											?>
											<div class="payment_method_<?php echo $gateway->id; ?>">
												<div class="ui radio checkbox">
													<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
													<label for="payment_method_<?php echo $gateway->id; ?>">
														<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>
													</label>
												</div>
												<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
													<div class="ui basic segment payment_box payment_method_<?php echo $gateway->id; ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
														<?php $gateway->payment_fields(); ?>
													</div>
												<?php endif; ?>
											</div>
											<?php
										}
									} else {

										echo '<p>' . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) . '</p>';

									}
								?>
							</div>
						<?php endif; ?>

						<div class="form-row place-order">
							<?php wp_nonce_field( 'woocommerce-pay' ); ?>
							<input type="hidden" name="woocommerce_pay" value="1" />
							<?php
								$pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', __( 'Pay for order', 'woocommerce' ) );

								echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="ui right floated button green" id="place_order" value="' . esc_attr( $pay_order_button_text ) . '" data-value="' . esc_attr( $pay_order_button_text ) . '" />' );
							?>
						</div>

					</section>

				</form>

			</div>
		</div>
	</div>
</section>
