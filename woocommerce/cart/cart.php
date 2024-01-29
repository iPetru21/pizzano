<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); 
?>

<!-- Shopping Cart-->
<section class="section section-lg bg-default">
    <div class="container">
        <!-- shopping-cart-->
        <form class="table-custom-responsive" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post"> 
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <table class="table-custom table-cart">
            <thead>
            <tr>
                <th><?php esc_html_e( 'Product name', 'woocommerce' ); ?></th>
                <th><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                <th><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                            <td>
                                <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                if ( ! $product_permalink ) {
                                    printf( '<a class="table-cart-figure" href="#">%s</a>', $thumbnail ); // PHPCS: XSS ok.
                                    printf( '<a class="table-cart-link" href="#">%s</a>', $_product->get_name() ); // PHPCS: XSS ok.
                                } else {
                                    printf( '<a class="table-cart-figure" href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                    printf( '<a class="table-cart-link" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ); // PHPCS: XSS ok.
                                }
                                
                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                // Meta data.
                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                // Backorder notification.
                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                } 
                                ?>
                            </td>

                            <td data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                ?>
                            </td>

                            <td data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                <?php
                                if ( $_product->is_sold_individually() ) {
                                    $min_quantity = 1;
                                    $max_quantity = 1;
                                } else {
                                    $min_quantity = 0;
                                    $max_quantity = $_product->get_max_purchase_quantity();
                                }

                                $product_quantity = woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $max_quantity,
                                        'min_value'    => $min_quantity,
                                        'product_name' => $_product->get_name(),
                                    ),
                                    $_product,
                                    false
                                ); 
                                //echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.

                                ?>
                                <div class="table-cart-stepper">
                                    <input class="form-input" type="number" data-zeros="true" name="<?= "cart[{$cart_item_key}][qty]" ?>" value="<?= $cart_item['quantity'] ?>" min="<?= $min_quantity ?>" max="<?= ( $max_quantity === -1 ) ? 10 : $max_quantity ?>">
                                </div>
                            </td>

                            <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
            </tbody>
        </table>
        <div class="group-xxxl group-middle justify-content-md-end">
            <div>
                <div class="group-xxl group-middle">
                    <p class="big text-gray-500"><?= esc_html_e( 'Total', 'woocommerce' ) ?></p>
                    <h4 class="text-spacing-75">
                        <?php wc_cart_totals_subtotal_html(); ?>
                    </h4>
                </div>
            </div>
            <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
            <a href="<?php echo get_permalink( 46 ); ?>" class="button button-lg button-width-240 button-primary button-winona">Checkout</a>
            <?php do_action( 'woocommerce_cart_actions' ); ?>
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </div>
    </form>
    </div>
</section>