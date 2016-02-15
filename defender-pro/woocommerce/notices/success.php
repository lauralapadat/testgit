<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>
<section class="woocommerce-message">
	<div class="ui page grid">
		<div class="column">
			<?php foreach ( $messages as $message ) : ?>
				<div class="ui success icon message">
					<i class="check circle icon"></i>
					<div class="content">
						<?php echo wp_kses_post( $message ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
