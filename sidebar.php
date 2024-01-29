<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PizzaHouse
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="col-lg-4 col-xl-3">
    <div class="aside row row-60">
	    <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</div><!-- #secondary -->
