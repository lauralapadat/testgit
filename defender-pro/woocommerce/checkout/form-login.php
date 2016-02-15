<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action('woocommerce_after_checkout_form', $checkout);

if ( is_user_logged_in() || 'no' === get_option('woocommerce_enable_checkout_login_reminder') ) {
	return;
}

$info_message  = '<a href="#" class="ui right floated button showlogin">' . __('Click here to login', 'woocommerce') . '</a>';
$info_message .= '<p>' . apply_filters( 'woocommerce_checkout_login_message', __('Returning customer? Please login before placing your order.', 'woocommerce') ) . '</p>';
wc_print_notice($info_message, 'notice');

woocommerce_login_form([
	'message'  => __('If you have shopped with us before please login below. If you are a new customer please proceed to place your order and an account will be created for you.', 'woocommerce'),
	'redirect' => wc_get_page_permalink('checkout'),
	'hidden'   => true
]);
