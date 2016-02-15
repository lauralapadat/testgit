<?php
/**
 * Cart errors page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

defender_print_page_heading(['acf_page_id' => 5]);

wc_print_notices();

$info_message  = '<a class="ui right floated button wc-backward" href="'. wc_get_page_permalink( 'cart' ) .'">'. __( 'Return To Cart', 'woocommerce' ) .'</a>';
$info_message .= '<p>'. __( 'There are some issues with the items in your cart (shown below). Please go back to the cart page and resolve these issues before checking out.', 'woocommerce' ) .'</p>';
wc_print_notice($info_message, 'notice');

do_action( 'woocommerce_cart_has_errors' );
