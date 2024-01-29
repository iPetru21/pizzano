<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<ul class="list list-description d-inline-block d-md-block">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
    <li>
		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
    </li>
	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<li><span>' . _n( 'Category:</span><span>', 'Categories:</span><span>', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span></li>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<li><span>' . _n( 'Tag:', 'Tags:</span><span>', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span></li>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

    <?php 
        // $attributes = $product->get_attributes();
        
        // foreach( $attributes as $attribute ){
        //     echo '<li>';
        //     echo '<span>' . $attribute->get_name() . ':</span>';
        //     echo '<span>';
        //     $options = $attribute->get_options();

        //     foreach( $options as $option ) {
        //         echo $option . ' ';
        //     }
        //     echo '</span>';
        //     echo '</li>';
        // }
    ?>
</ul>