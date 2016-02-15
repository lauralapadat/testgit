<?php
/**
 * @package WordPress
 * @subpackage Defender-Pro-Theme
 * @since Defender-Pro 0.1
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

?><!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!--[if IE ]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <?php if ( is_search() ): ?><meta name="robots" content="noindex, nofollow" /><?php endif; ?>
    <meta name="title" content="<?php wp_title('|'); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="globalsign-domain-verification" content="KOjuwLt_7NFLXnahwzT5mRMOlmVWOXuBCV14KWxfyj" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( is_single() ):
        setup_postdata($post);
    ?>
        <meta property="og:url" content="<?php the_permalink(); ?>"/>
        <meta property="og:title" content="<?php single_post_title(''); ?>" />
        <meta property="og:description" content="<?php echo strip_tags( get_the_excerpt() ); ?>" />
        <meta property="og:image" content="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id() ); ?>" />
        <meta property="og:type" content="article" />
    <?php else: ?>
        <meta property="og:description" content="<?php bloginfo('description'); ?>" />
        <meta property="og:type" content="website" />
    <?php endif; ?>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/img/favicon.ico'; ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header" role="banner">
        <div class="ui page grid">
            <div class="sixteen wide column nav-column">
                <nav id="nav" class="ui menu" role="navigation">
                    <div class="left menu">
                        <a class="item logo" href="/" rel="home"><?php bloginfo( 'name' ); ?></a>
                        <a class="item dropdown products" href="/products/">Products <i class="dropdown icon"></i></a>
                        <div class="ui flowing popup">
                            <div class="ui divided grid">
                                <div class="row">
                                    <div class="column">
                                        <div class="ui fluid vertical borderless menu">
                                            <a class="item" href="/products/defender-pro-free/">Defender Pro Free</a>
                                            <a class="item" href="/products/defender-pro-total/">Defender Pro Total</a>
                                            <a class="item" href="/products/defender-pro-ultimate/">Defender Pro Ultimate</a>
                                            <a class="item" href="/products/defender-pro-lifetime">Defender Pro Lifetime</a>
                                            <a class="item" href="/products/backup-vault/">Backup Vault</a>
                                            <a class="item" href="/products/pc-medic/">PC Medic™</a>
                                            <a class="item" href="/products/mac-medic/">Mac Medic</a>
                                            <a class="item" href="/products/defender-driver-control/">Defender Driver Control</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="item" href="/partners/">Partners</a>
                        <a class="item" href="/about/">About</a>
                        <a class="item support" href="/support/">Support</a>
                    </div>
                    <div class="right menu">
                        <?php if ( is_user_logged_in() ): ?>
                            <a class="item dropdown account" href="/account/">My Account <i class="dropdown icon"></i></a>
                            <div class="ui flowing popup">
                                <div class="ui grid">
                                    <div class="column">
                                        <div class="ui fluid vertical borderless menu">
                                            <!--
                                            <a class="item" href="/account/orders/">Order History</a>
                                            -->
                                            <a class="item" href="/account/edit-account/">Edit Details</a>
                                            <a class="item" href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <a class="item" href="/account/">My Account</a>
                        <?php endif; ?>
                        <a id="cart" class="item cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                            <div class="ui horizontal statistic">
                                <div class="label">
                                    <i class="shop link icon"></i>
                                    <span class="hidden">Cart</span>
                                </div>
                                <div class="value"><?php echo WC()->cart->cart_contents_count; ?></div>
                            </div>
                        </a>
                    </div>
                </nav>
            </div> <!-- .column -->
        </div> <!-- .ui.grid -->
    </header>
    <main id="content" role="main">
