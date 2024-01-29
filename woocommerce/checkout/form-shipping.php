<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
    <div class="col-md-10 col-lg-6" id="shipping-form">

		<h5><?php esc_html_e( 'Adresă de livrare', 'woocommerce' ); ?></h5>
		<div class="rd-form rd-mailform form-checkout">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="row row-14 gutters-14">
				<?php
				$fields = $checkout->get_checkout_fields( 'shipping' );

                foreach ( $fields as $key => $field ) {
                    if( $key == 'shipping_company' || $key == 'shipping_address_1' ): ?>
                        <div class="col-12">
                            <div class="form-wrap">
                                <input class="form-input" placeholder="<?= $field['label'] ?>" id="<?= $key ?>" type="text" name="<?= $key ?>" data-constraints="@Required"/>
                            </div>
                        </div>
                    <?php elseif( $key == 'shipping_country' ): ?>
                        <div style="display: none;" class="col-sm-6">
                            <div class="form-wrap">
                                <input class="form-input" placeholder="<?= $field['label'] ?>" id="<?= $key ?>" value="RO" type="text" name="<?= $key ?>" data-constraints="@Required"/>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-6">
                            <div class="form-wrap">
                                <input class="form-input" placeholder="<?= $field['label'] ?>" id="<?= $key ?>" type="text" name="<?= $key ?>" data-constraints="@Required"/>
                            </div>
                        </div>
                    <?php endif;
                }
				?>
			</div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

    </div>
<?php endif; ?>

<?php /*
<div class="woocommerce-additional-fields">
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

			<h3><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>

		<?php endif; ?>

		<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>*/?>
