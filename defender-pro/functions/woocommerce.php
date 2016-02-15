<?php
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

/*
|--------------------------------------------------------------------------
| WooCommerce
|--------------------------------------------------------------------------
*/

// Disable WooCommerce default styles
add_filter('woocommerce_enqueue_styles', function() { return []; });


// Add buysafe integration
add_action('wp_footer', function()
{
    global $wp;

    $buysafe_hash = 'eegFwV6yOdicxSvEFhVR6UjJacCpcAsysjh9C0DLPY7oDCUHkysFStw6KlnMit7ag0e9QvVTi%2BWPJlLs8vXmGQ%3D%3D';
?>
    <!-- BEGIN: buySAFE Seal -->
    <span id="buySAFE_SealSpan"></span>
    <script defer src="//seal.buysafe.com/private/rollover/rollover.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if(window.buySAFE && buySAFE.Loaded) {
                buySAFE.Hash = '<?php echo $buysafe_hash; ?>';
                buySAFE.WriteSeal("buySAFE_SealSpan", "GuaranteedSeal");
            }
        });
    </script>
    <!-- END: buySAFE Seal -->
<?php
    if ( is_order_received_page() )
    {
        $order_id = isset($wp->query_vars['order-received']) ? $wp->query_vars['order-received'] : 0;

        if ( 0 < $order_id )
        {
            $order = new WC_Order($order_id);
?>
    <!-- BEGIN: buySAFE Guarantee -->
    <span id="BuySafeGuaranteeSpan"></span>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if(window.buySAFE && buySAFE.Loaded) {
               buySAFE.Hash = '<?php echo $buysafe_hash; ?>';
               buySAFE.Guarantee.order = '<?php echo esc_js( $order->get_order_number() ); ?>';
               buySAFE.Guarantee.subtotal = '<?php echo esc_js( $order->get_total() ); ?>';
               buySAFE.Guarantee.email = '<?php echo esc_js( $order->billing_email ); ?>';
               WriteBuySafeGuarantee("JavaScript");
            }
        });
    </script>
    <!-- END: buySAFE Guarantee -->
<?php
        }
    }
}, 999999);


// Remove WC Social Login from checkout
function defender_remove_wc_social_login_resources()
{
    if ( !is_admin() )
    {
        wp_dequeue_style('wc-social-login-frontend');
        wp_dequeue_script('wc-social-login-frontend');
        wp_deregister_script('wc-social-login-frontend');
    }
}

add_action('woocommerce_before_template_part', 'defender_remove_wc_social_login_resources', 99999);
add_action('woocommerce_before_my_account', 'defender_remove_wc_social_login_resources', 99999);
add_action('woocommerce_login_form_end', 'defender_remove_wc_social_login_resources', 99999);

// Move social stuff from above header to inside page area
add_action('init', function()
{
    if ( function_exists('wc_social_login') )
        remove_action('woocommerce_before_template_part', [wc_social_login()->frontend, 'maybe_render_social_buttons']);
}, 11);


// Remove generator meta tag
remove_action('wp_head','wc_generator_tag');


// Remove the WooCommerce wrapper
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


// Remove breadcrumbs from shop and product pages
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);


// Remove page titles from products archive
add_filter('woocommerce_show_page_title', function() { return false; });


// Remove add to cart template from product loop
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


// Set create a account at checkout to true by default
add_filter('woocommerce_create_account_default_checked', function() { return true; });


// Modify checkout fields
add_filter('woocommerce_checkout_fields', function($fields)
{
    // Make phone optional
    $fields['billing']['billing_phone']['required'] = false;

    // Add label to address 2
    $fields['billing']['billing_address_1']['label'] = __('Address (Line 1)', 'woocommerce');
    $fields['billing']['billing_address_2']['label'] = __('Address (Line 2)', 'woocommerce');

    // Add autocomplete
    // https://html.spec.whatwg.org/multipage/forms.html#autofill-field
    $fields['billing']['billing_first_name']['autocomplete'] = ['billing', 'given-name'];
    $fields['billing']['billing_last_name']['autocomplete']  = ['billing', 'family-name'];
    $fields['billing']['billing_address_1']['autocomplete']  = ['billing', 'address-line1'];
    $fields['billing']['billing_address_2']['autocomplete']  = ['billing', 'address-line2'];
    $fields['billing']['billing_country']['autocomplete']    = ['billing', 'country'];
    $fields['billing']['billing_city']['autocomplete']       = ['billing', 'address-level2'];
    $fields['billing']['billing_state']['autocomplete']      = ['billing', 'address-level1'];
    $fields['billing']['billing_postcode']['autocomplete']   = ['billing', 'postal-code'];
    $fields['billing']['billing_email']['autocomplete']      = ['billing', 'email'];
    $fields['billing']['billing_phone']['autocomplete']      = ['billing', 'tel'];

    // Remove order notes
    unset($fields['order']['order_comments']);

    // Remove company
    unset($fields['billing']['billing_company']);

    // Remove placeholders
    unset($fields['billing']['billing_city']['placeholder']);
    unset($fields['billing']['billing_state']['placeholder']);
    unset($fields['billing']['billing_postcode']['placeholder']);

    // Reorder fields
    $order = [
        'billing_first_name',
        'billing_last_name',
        'billing_address_1',
        'billing_address_2',
        'billing_country',
        'billing_city',
        'billing_state',
        'billing_postcode',
        'billing_email',
        'billing_phone'
    ];

    foreach ($order as $field)
    {
        $ordered_fields[$field] = $fields['billing'][$field];
    }

    $fields['billing'] = $ordered_fields;

    return $fields;
});


// Remove placeholders from city, state and postcode
add_filter('woocommerce_default_address_fields', function($fields)
{
    unset($fields['city']['placeholder']);
    unset($fields['state']['placeholder']);
    unset($fields['postcode']['placeholder']);

    return $fields;
});


// Change postcode to postal code for Canada at checkout and remove placeholders
add_filter('woocommerce_get_country_locale', function($locales)
{
    $locales['CA']['postcode']['label'] = __('Postal Code', 'woocommerce');

    foreach ($locales as $locale => $fields)
    {
        unset($locales[$locale]['city']['placeholder']);
        unset($locales[$locale]['state']['placeholder']);
        unset($locales[$locale]['postcode']['placeholder']);
    }

    return $locales;
});


// Icons for payment gateway
add_filter('woocommerce_gateway_icon', function($icon, $id)
{
    switch ($id)
    {
        case 'fac':
            $path = '//cdn.defender-pro.com/wp-content/plugins/woocommerce/assets/images/icons/credit-cards/';

            $icon  = '<img src="' . $path . 'visa.png" alt="Visa" />';
            $icon .= '<img src="' . $path . 'mastercard.png" alt="MasterCard" />';

            break;

        case 'paypal':
            $path = get_template_directory_uri() . '/assets/img/';

            $icon = '<img src="' . $path . 'paypal-icon.png" alt="PayPal" />';

            $path = '//cdn.defender-pro.com/wp-content/plugins/woocommerce/assets/images/icons/credit-cards/';

            $icon .= '<img src="' . $path . 'visa.png" alt="Visa" />';
            $icon .= '<img src="' . $path . 'mastercard.png" alt="MasterCard" />';
            $icon .= '<img src="' . $path . 'amex.png" alt="American Express" />';

            break;
    }

    return $icon;
}, 10, 2);


// Modify the default credit_card_form to be SUI friendly and follow the autofill specs
add_filter('woocommerce_credit_card_form_fields', function($default_fields, $id)
{
    $args = [
        'fields_have_names' => true,
    ];

    return $default_fields = [
        'card-number-field' => '<div class="field form-row form-row-wide required validate-required validate-card-number" id="' . esc_attr($id) . '-card-number-field">
            <label for="' . esc_attr($id) . '-card-number">' . __( 'Card Number', 'woocommerce' ) . '</label>
            <input id="' . esc_attr($id) . '-card-number" class="input-text wc-credit-card-form-card-number" type="tel" maxlength="20" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" name="' . ( $args['fields_have_names'] ? $id . '-card-number' : '' ) . '" />
        </div>',
        'card-expiry-field' => '<div class="field form-row form-row-first required validate-required validate-card-expiry" id="' . esc_attr($id) . '-card-expiry-field">
            <label for="' . esc_attr($id) . '-card-expiry">' . __( 'Card Expiry', 'woocommerce' ) . '</label>
            <input id="' . esc_attr($id) . '-card-expiry" class="input-text wc-credit-card-form-card-expiry" type="tel" autocomplete="cc-exp" placeholder="' . esc_attr__( 'MM / YY', 'woocommerce' ) . '" name="' . ( $args['fields_have_names'] ? $id . '-card-expiry' : '' ) . '" />
        </div>',
        'card-cvc-field' => '<div class="field form-row form-row-last required validate-required validate-card-cvc" id="' . esc_attr($id) . '-card-cvc-field">
            <label for="' . esc_attr($id) . '-card-cvc">' . __( 'Card Code', 'woocommerce' ) . '</label>
            <input id="' . esc_attr($id) . '-card-cvc" class="input-text wc-credit-card-form-card-cvc" type="tel" autocomplete="off" placeholder="' . esc_attr__( 'CVC', 'woocommerce' ) . '" name="' . ( $args['fields_have_names'] ? $id . '-card-cvc' : '' ) . '" />
        </div>'
    ];
}, 10, 2);


// Change add to cart text to Buy Now
function defender_cart_button_text()
{
    return __('Buy Now', 'woocommerce');
}

add_filter('woocommerce_product_add_to_cart_text', 'defender_cart_button_text');
add_filter('woocommerce_product_single_add_to_cart_text', 'defender_cart_button_text');


// Print add to cart button
function defender_wc_print_add_to_cart($product)
{
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="ui button %s product_type_%s"><i class="icon shop"></i>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            esc_attr( $product->product_type ),
            esc_html( $product->add_to_cart_text() )
        ),
    $product );
}


// Print download button
function defender_wc_print_download($product)
{
    $url = get_field('download_link', $product->id) ?: $product->get_file()['file'];

    echo apply_filters( 'woocommerce_loop_download_link',
        sprintf( '<a href="%s" class="ui dark button %s product_type_%s"><i class="icon download"></i>%s</a>',
            esc_url( $url ),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            esc_attr( $product->product_type ),
            esc_html( 'Free Download' )
        ),
    $product );
}


// Modify button in add to cart messages
add_filter('wc_add_to_cart_message', function($message, $product_id)
{
    return preg_replace(
        '/<a href="(.*)" class="button wc-forward">(.*)<\/a> (.*)/',
        '<a href="$1" class="ui right floated button wc-forward">$2</a> <p>$3</p>',
        $message
    );
}, 10, 2);


// Replace proceed to checkout button markup
function woocommerce_button_proceed_to_checkout()
{
    $checkout_url = WC()->cart->get_checkout_url();

    echo '<a href="' . $checkout_url . '" class="ui right floated button checkout-button alt wc-forward">' . __('Proceed to Checkout', 'woocommerce') . '</a>';
}


// Add currency to checkout and cart page prices
function defender_wc_add_price_suffix($format, $currency_pos)
{
    switch ($currency_pos)
    {
        case 'left':
            $currency = get_woocommerce_currency();
            $format = '%1$s%2$s ' . $currency;
        break;
    }

    return $format;
}

function defender_wc_add_currency_suffix_to_price()
{
    add_action('woocommerce_price_format', 'defender_wc_add_price_suffix', 1, 2);
}

add_action('woocommerce_cart_totals_before_order_total', 'defender_wc_add_currency_suffix_to_price');
add_action('woocommerce_review_order_before_order_total', 'defender_wc_add_currency_suffix_to_price');


// Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', function($fragments)
{
    ob_start();
    ?>
        <a id="cart" class="item cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
            <div class="ui horizontal statistic">
                <div class="label">
                    <i class="shop link icon"></i>
                    <span class="hidden">Cart</span>
                </div>
                <div class="value"><?php echo WC()->cart->cart_contents_count; ?></div>
            </div>
        </a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
});


// Allow exe or dmg for digital downloads
add_filter('upload_mimes', function($mimetypes, $user)
{
    // Only allow these mimetypes for admins or shop managers
    $manager = $user ? user_can($user, 'manage_woocommerce') : current_user_can('manage_woocommerce');

    if ($manager)
    {
        $mimetypes = array_merge($mimetypes, [
            'exe' => 'application/octet-stream',
            'dmg' => 'application/octet-stream',
            'pkg' => 'application/octet-stream'
        ]);
    }

    return $mimetypes;
}, 10, 2);


// Add download insurance to cart when adding products
add_action('woocommerce_add_to_cart', function($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
{
    $download_insurance_id     = 697;
    $download_insurance_exists = false;

    // Skip any product matching the download insurance id
    if ( $product_id == $download_insurance_id ) return;

    // Make sure download insurance doesn't already exist in the cart
    if ( count( WC()->cart->get_cart() ) > 0 )
    {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $values )
        {
            $_product = $values['data'];

            if ( $_product->id == $download_insurance_id )
            {
                $download_insurance_exists = true;
                break;
            }
        }
    }

    if (!$download_insurance_exists)
    {
        WC()->cart->add_to_cart($download_insurance_id);
    }
}, 10, 6);


// Autocomplete virtual products
add_filter('woocommerce_payment_complete_order_status', function($order_status, $order_id)
{
    $order = new WC_Order($order_id);

    if ( 'processing' == $order_status && ('on-hold' == $order->status || 'pending' == $order->status || 'failed' == $order->status) )
    {
        $virtual_order = null;

        if ( count( $order->get_items() ) > 0 )
        {
            foreach ( $order->get_items() as $item )
            {
                if ( 'line_item' == $item['type'] )
                {
                    $_product = $order->get_product_from_item($item);

                    if ( !$_product->is_virtual() )
                    {
                        $virtual_order = false;
                        break;
                    }
                    else
                    {
                        $virtual_order = true;
                    }
                }
            }
        }
        if ($virtual_order)
        {
            $order_status = 'completed';
        }
    }

    return $order_status;
}, 10, 2);


// Replace form field function with semantic ui friendly one
function woocommerce_form_field($key, $args, $value = null) {
    $defaults = [
        'type'              => 'text',
        'label'             => '',
        'description'       => '',
        'placeholder'       => '',
        'maxlength'         => false,
        'required'          => false,
        'id'                => $key,
        'class'             => [],
        'label_class'       => [],
        'input_class'       => [],
        'return'            => false,
        'options'           => [],
        'custom_attributes' => [],
        'validate'          => [],
        'default'           => '',
        'autocomplete'      => []
    ];

    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

    $after = '';

    if ( $args['required'] ) {
        $args['class'][] = 'validate-required';
        $args['class'][] = 'required';
    }

    $required = '';

    $args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

    if ( is_string( $args['label_class'] ) ) {
        $args['label_class'] = array( $args['label_class'] );
    }

    if ( is_null( $value ) ) {
        $value = $args['default'];
    }

    // Custom attribute handling
    $custom_attributes = array();

    if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
        foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
            $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
        }
    }

    if ( ! empty( $args['validate'] ) ) {
        foreach( $args['validate'] as $validate ) {
            $args['class'][] = 'validate-' . $validate;
        }
    }

    // Autocomplete
    $autocomplete = '';

    if ( ! empty( $args['autocomplete'] ) ) {
        $autocomplete = ' autocomplete="';

        if ( is_array( $args['autocomplete'] ) ) {
            $autocomplete .= esc_attr( implode( ' ', $args['autocomplete'] ) );
        }
        else {
            $autocomplete .= esc_attr( $args['autocomplete'] );
        }

        $autocomplete .= '"';
    }

    $field = '';
    $label_id = $args['id'];
    $field_container = '<div class="field form-row %1$s" id="%2$s">%3$s</div>';

    switch ( $args['type'] ) {
        case 'country' :

            $countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

            if ( sizeof( $countries ) == 1 ) {

                $field = '<strong>' . current( array_values( $countries ) ) . '</strong>';

                $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

            } else {

                $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' class="ui search selection dropdown country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . '>'
                        . '<option value="">'.__( 'Select a country&hellip;', 'woocommerce' ) .'</option>';

                foreach ( $countries as $ckey => $cvalue ) {
                    $field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';
                }

                $field .= '</select>';

                $field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '" /></noscript>';

            }

            break;
        case 'state' :

            /* Get Country */
            $country_key = $key == 'billing_state' ? 'billing_country' : 'shipping_country';
            $current_cc  = WC()->checkout->get_value( $country_key );
            $states      = WC()->countries->get_states( $current_cc );

            if ( is_array( $states ) && empty( $states ) ) {

                $field_container = '<div class="field form-row %1$s" id="%2$s" style="display: none">%3$s</div>';

                $field = '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

            } elseif ( is_array( $states ) ) {

                $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' class="ui search selection dropdown state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
                    <option value="">'.__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';

                foreach ( $states as $ckey => $cvalue ) {
                    $field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';
                }

                $field .= '</select>';

            } else {

                $field = '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'"' . $autocomplete . ' value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

            }

            break;
        case 'textarea' :

            $field = '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea>';

            break;
        case 'checkbox' :

            $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>
                    <input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' value="1" '.checked( $value, 1, false ) .' /> '
                     . $args['label'] . $required . '</label>';

            break;
        case 'password' :

            $field = '<input type="password" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

            break;
        case 'text' :

            $field = '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

            break;
        case 'email' :

            $field = '<input type="email" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

            break;
        case 'tel' :

            $field = '<input type="tel" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

            break;
        case 'select' :

            $options = $field = '';

            if ( ! empty( $args['options'] ) ) {
                foreach ( $args['options'] as $option_key => $option_text ) {
                    if ( "" === $option_key ) {
                        // If we have a blank option, select2 needs a placeholder
                        if ( empty( $args['placeholder'] ) ) {
                            $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
                        }
                        $custom_attributes[] = 'data-allow_clear="true"';
                    }
                    $options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';
                }

                $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"' . $autocomplete . ' class="ui dropdown select '.esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
                        ' . $options . '
                    </select>';

            }

            break;
        case 'radio' :

            $label_id = current( array_keys( $args['options'] ) );

            if ( ! empty( $args['options'] ) ) {
                foreach ( $args['options'] as $option_key => $option_text ) {
                    $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . $autocomplete . checked( $value, $option_key, false ) . ' />';
                    $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) .'">' . $option_text . '</label>';
                }
            }

            $field .= '</div>' . $after;

            break;
    }

    if ( ! empty( $field ) ) {
        $field_html = '';

        if ( $args['label'] && 'checkbox' != $args['type'] ) {
        	$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . '</label>';
        }

        $field_html .= $field;

        if ( $args['description'] ) {
        	$field_html .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
        }

        $container_class = 'field form-row ' . esc_attr( implode( ' ', $args['class'] ) );
        $container_id = esc_attr( $args['id'] ) . '_field';

        $field = sprintf( $field_container, $container_class, $container_id, $field_html ) . $after;
    }

    $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

    if ( $args['return'] ) {
        return $field;
    } else {
        echo $field;
    }
}
