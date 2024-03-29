<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="box-comment box-comment-product" id="li-comment-<?php comment_ID(); ?>">
    <div class="unit flex-column flex-md-row">
        <div class="unit-left">
            <a class="box-comment-figure" href="#">
            <?php
            /**
             * The woocommerce_review_before hook
             *
             * @hooked woocommerce_review_display_gravatar - 10
             */
            do_action( 'woocommerce_review_before', $comment );
            ?>
            <!-- <img src="images/team-5-83x83.jpg" alt="" width="83" height="83"> -->
            </a>
        </div>
        <div class="unit-body">
            <div class="group-md group-justify">
                <div>
                    <div class="group-md group-middle">
                        <p class="box-comment-author"><a href="#"><?php comment_author(); ?></a></p>
                        <div class="box-rating">
                            <?php
                            /**
                             * The woocommerce_review_before_comment_meta hook.
                             *
                             * @hooked woocommerce_review_display_rating - 10
                             */
                            do_action( 'woocommerce_review_before_comment_meta', $comment );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="box-comment-time">
                    <?php
                        /**
                        * The woocommerce_review_meta hook.
                        *
                        * @hooked woocommerce_review_display_meta - 10
                        */
                        do_action( 'woocommerce_review_meta', $comment );

                        do_action( 'woocommerce_review_before_comment_text', $comment );
                    ?>
                </div>
            </div>
            <p class="box-comment-text">            
                <?php
                /**
                 * The woocommerce_review_comment_text hook
                 *
                 * @hooked woocommerce_review_display_comment_text - 10
                 */
                do_action( 'woocommerce_review_comment_text', $comment );

                do_action( 'woocommerce_review_after_comment_text', $comment );
                ?>
            </p>
        </div>
    </div>
</div>

