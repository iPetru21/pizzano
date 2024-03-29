<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="tabs-custom tabs-horizontal tabs-corporate" id="woo">
		<ul class="nav nav-tabs">
            <?php $is_first = true; ?>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="nav-item" role="presentation">
					<a class="nav-link<?php if( $is_first ) echo ' active'; ?>" href="#woo-<?php echo esc_attr( $key ); ?>" data-toggle="tab">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
                <?php $is_first = false; ?>
			<?php endforeach; ?>
		</ul>
        <div class="tab-content">
            <?php $is_first = true; ?>
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                <div class="tab-pane fade<?php if( $is_first ) echo ' show active'; ?>" id="woo-<?php echo esc_attr( $key ); ?>">
                    <?php
                    if ( isset( $product_tab['callback'] ) ) {
                        call_user_func( $product_tab['callback'], $key, $product_tab );
                    }
                    $is_first = false;
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
