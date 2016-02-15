<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

defender_print_page_heading(['acf_page_id' => 5]);

wc_print_notices();

$info_message  = '<a class="ui right floated button wc-backward" href="'. apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) .'">'. __( 'Return To Shop', 'woocommerce' ) .'</a>';
$info_message .= '<p>'. __( 'Your cart is currently empty.', 'woocommerce' ) .'</p>';
wc_print_notice($info_message, 'notice');
