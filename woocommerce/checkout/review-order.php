<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="col-md-10 col-lg-6">
    <h5><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?></h5>
    <div class="table-custom-responsive">
    <table class="table-custom table-custom-primary table-checkout">
        <tbody>
        <tr>
            <td><?php esc_html_e( 'Cart Subtotal', 'woocommerce' ); ?></td>
            <td><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <tr>
            <td><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></td>
            <td><?php wc_cart_totals_shipping_html(); ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><?php esc_html_e( 'Total', 'woocommerce' ); ?></td>
            <td><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>
        </tbody>
    </table>
    </div>
</div>