<?php 
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // Integration Woocommerce in Theme
    function pizzahouse_add_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }

    // Disable all stylesheets
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    wp_dequeue_script( '' );

    add_action( 'after_setup_theme', 'pizzahouse_add_woocommerce_support' );

    //==========================================================
    // Add Icon meta box in Product Category Taxonomy ==========
    //==========================================================

    add_action( 'product_cat_add_form_fields', 'pizzahouse_add_category_fields' );
    add_action( 'product_cat_edit_form_fields', 'pizzahouse_edit_category_fields', 5 );
    add_action( 'created_term', 'pizzahouse_save_category_fields', 5, 3 );
    add_action( 'edit_term', 'pizzahouse_save_category_fields', 5, 3 );

    function pizzahouse_add_category_fields() {
        ?>
        <div class="form-field">
            <label for="icon"><?php esc_html_e( 'Icon', 'woocommerce' ); ?></label>
            <select id="icon" name="icon" class="postform">
                <option value="fa-empty-set"><?php esc_html_e( 'Default', 'woocommerce' ); ?></option>
                <option value="fa-leaf"><?php esc_html_e( 'Leaf', 'woocommerce' ); ?></option>
                <option value="fa-pizza-slice"><?php esc_html_e( 'Pizza Slice', 'woocommerce' ); ?></option>
                <option value="fa-burger"><?php esc_html_e( 'Burger', 'woocommerce' ); ?></option>
                <option value="fa-ice-cream"><?php esc_html_e( 'Ice Cream', 'woocommerce' ); ?></option>
                <option value="fa-glass"><?php esc_html_e( 'Drink', 'woocommerce' ); ?></option>
                <option value="fa-fish"><?php esc_html_e( 'Sea Food', 'woocommerce' ); ?></option>
                <option value="fa-wheat-awn"><?php esc_html_e( 'Pasta', 'woocommerce' ); ?></option>
                <option value="fa-drumstick-bite"><?php esc_html_e( 'Drumstick', 'woocommerce' ); ?></option>
                <option value="fa-cheese"><?php esc_html_e( 'Breakfast', 'woocommerce' ); ?></option>
                <option value="fa-pepper-hot"><?php esc_html_e( 'Topping', 'woocommerce' ); ?></option>
            </select>
        </div>
        <?php
    }

    function pizzahouse_edit_category_fields( $term ) {
        $icon = get_term_meta( $term->term_id, 'icon', true );
        ?>
        <tr class="form-field term-display-type-wrap">
            <th scope="row" valign="top"><label><?php esc_html_e( 'Icon', 'woocommerce' ); ?></label></th>
            <td>
                <select id="icon" name="icon" class="postform">
                    <option value="fa-empty-set" <?php selected( 'fa-empty-set', $icon ); ?>><?php esc_html_e( 'Default', 'woocommerce' ); ?></option>
                    <option value="fa-leaf" <?php selected( 'fa-leaf', $icon ); ?>><?php esc_html_e( 'Leaf', 'woocommerce' ); ?></option>
                    <option value="fa-pizza-slice" <?php selected( 'fa-pizza-slice', $icon ); ?>><?php esc_html_e( 'Pizza Slice', 'woocommerce' ); ?></option>
                    <option value="fa-burger" <?php selected( 'fa-burger', $icon ); ?>><?php esc_html_e( 'Burger', 'woocommerce' ); ?></option>
                    <option value="fa-ice-cream" <?php selected( 'fa-ice-cream', $icon ); ?>><?php esc_html_e( 'Ice Cream', 'woocommerce' ); ?></option>
                    <option value="fa-glass" <?php selected( 'fa-glass', $icon ); ?>><?php esc_html_e( 'Drink', 'woocommerce' ); ?></option>
                    <option value="fa-fish" <?php selected( 'fa-fish', $icon ); ?>><?php esc_html_e( 'Sea Food', 'woocommerce' ); ?></option>
                    <option value="fa-wheat-awn" <?php selected( 'fa-wheat-awn', $icon ); ?>><?php esc_html_e( 'Pasta', 'woocommerce' ); ?></option>
                    <option value="fa-drumstick-bite" <?php selected( 'fa-drumstick-bite', $icon ); ?>><?php esc_html_e( 'Drumstick', 'woocommerce' ); ?></option>
                    <option value="fa-cheese" <?php selected( 'fa-cheese', $icon ); ?>"><?php esc_html_e( 'Breakfast', 'woocommerce' ); ?></option>
                    <option value="fa-pepper-hot" <?php selected( 'fa-pepper-hot', $icon ); ?>><?php esc_html_e( 'Topping', 'woocommerce' ); ?></option>
                </select>
            </td>
        </tr>
        <?php
    }

    function pizzahouse_save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
        if ( isset( $_POST['icon'] ) && 'product_cat' === $taxonomy ) { // WPCS: CSRF ok, input var ok.
            update_term_meta( $term_id, 'icon', esc_attr( $_POST['icon'] ) ); // WPCS: CSRF ok, sanitization ok, input var ok.
        }
    }

    //==========================================================
    // content-product.php Custom template            ==========
    //==========================================================
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

    add_action( 'woocommerce_shop_loop_item_title', 'pizzhouse_template_loop_product_title', 5 );
    add_action( 'woocommerce_before_shop_loop_item', 'pizzahouse_template_loop_product_article_open', 5 );
    add_action( 'woocommerce_after_shop_loop_item', 'pizzahouse_template_loop_product_article_close', 15 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'pizzahouse_template_loop_product_data', 10 );

    add_filter( 'woocommerce_post_class', 'remove_post_class', 21, 3 ); //woocommerce use priority 20, so if you want to do something after they finish be more lazy
    add_filter( 'woocommerce_loop_add_to_cart_args', 'pizzahouse_loop_add_to_cart_args', 30 );

    function pizzahouse_loop_add_to_cart_args( $args ) {
        $args['class'] .= ' button button-xs button-primary button-winona';
        return $args;
    }

    function remove_post_class( $classes ) {
        if ( 'product' == get_post_type() ) {
            $classes = array_diff( $classes, array( 'product' ) );
        }
        return $classes;
    }
    function pizzahouse_template_loop_product_article_open() {
        ?>
        <article class="product wow fadeInLeft" data-wow-delay=".15s">
        <?php
    }
    function pizzahouse_template_loop_product_article_close() {
        echo '</article>';
    }
    function pizzahouse_template_loop_product_data() {
        global $product;
        $rating_count = $product->get_rating_count();
        $rating_average = $product->get_average_rating();
        ?>
        <div class="product-figure">
            <?php echo woocommerce_get_product_thumbnail(); ?>
        </div>
        <!-- Show rating -->
        <div class="product-rating rating-custom">
            <?php echo wc_get_rating_html( $rating_average, $rating_count ); ?>
        </div>
        <!-- Show title -->
        <h6 class="product-title">
            <?php echo $product->get_title(); ?>
        </h6>
        <!-- Show price -->
        <div class="product-price-wrap">
            <div class="product-price">
                <?php echo $product->get_price_html(); ?>
            </div>
        </div>
        <!-- Show buttons -->
        <div class="product-button">
            <div class="button-wrap">
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
            <div class="button-wrap">    
                <a class="button button-xs button-secondary button-winona" href="<?php echo $product->get_permalink(); ?>"><?php _e('View Product', 'pizzahouse'); ?></a>
            </div>
        </div>
        <?php
    }
}


    //==========================================================
    // single-product.php  Custom template            ==========
    //==========================================================

    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
    remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );

    add_action( 'woocommerce_before_main_content', 'pizzahouse_header_before_breadcrumb', 20 );
    add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 30);
    add_action( 'woocommerce_before_main_content', 'pizzahouse_header_after_breadcrumb', 40 );
    add_action( 'woocommerce_before_single_product', 'pizzahouse_output_all_notices', 3 );
    add_action( 'woocommerce_before_single_product', 'pizzahouse_before_single_product', 5 );
    add_action( 'woocommerce_before_single_product', 'pizzahouse_single_product_carousel', 20 );
    add_action( 'woocommerce_after_single_product', 'pizzahouse_div_end', 5 );
    add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );
    add_action( 'woocommerce_after_single_product', 'pizzahouse_after_single_product', 15 );
    add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
    add_action( 'woocommerce_single_product_summary', 'pizzahouse_summary_group_price_start', 7 );
    add_action( 'woocommerce_single_product_summary', 'pizzahouse_div_end', 12 );
    add_action( 'woocommerce_single_product_summary', 'pizzahouse_summary_rating', 10 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );
    add_action( 'woocommerce_share', 'pizzahouse_single_product_share', 10 );
    add_action( 'woocommerce_review_before_comment_meta', 'pizzahouse_summary_rating', 10 );

    add_filter( 'woocommerce_breadcrumb_defaults', 'pizzahouse_woocommerce_breadcrumb_defaults', 10 );
    add_filter( 'woocommerce_quantity_input_classes', 'pizzahouse_quantity_input_classes' );
    add_filter( 'woocommerce_product_tabs', 'pizzahouse_product_tabs', 25 );
    add_filter( 'woocommerce_review_gravatar_size', function(){
        return 83;
    }, 10 );
    add_filter( 'comment_form_fields', 'pizzahouse_comment_fields_order' );


    function pizzahouse_comment_fields_order( $fields ){
        $new_fields = array(); // сюда соберем поля в новом порядке
        $myorder = array('author','email','phone','comment'); // нужный порядок
    
        foreach( $myorder as $key ){
            $new_fields[ $key ] = $fields[ $key ];
            unset( $fields[ $key ] );
        }
        return $new_fields;
    }

    function pizzahouse_output_all_notices() {
        ?>
        <div class="container">
            <?php //woocommerce_output_all_notices(); ?>
        </div>
        <?php
    }

    function pizzahouse_product_tabs( $tabs ) {
        $tabs['description']['priority'] = 30;
        $tabs['reviews']['title'] = __( 'Comments', 'pizzahouse' );
        $tabs['reviews']['priority'] = 10;
        $tabs['additional_information']['priority'] = 20;
        $tabs['additional_information']['title'] = __( 'Informații suplimentare', 'pizzahouse' );
        $tabs['additional_information']['callback'] = function() {
            woocommerce_product_additional_information_tab();
        };
        return $tabs;
    } 

    function pizzahouse_single_product_share() {
        ?>
        <hr class="hr-gray-300">
        <div class="group-sm group-middle"><span class="single-product-social-title">Share</span>
            <div>
            <ul class="list-inline single-product-social-list list-inline-sm">
                <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
            </ul>
            </div>
        </div>
        <?php
    }

    function pizzahouse_quantity_input_classes() {
        return 'form-input';
    }

    function pizzahouse_quantity_stepper_up() {
        echo '<span class="stepper-arrow up"></span>';
    }

    function pizzahouse_quantity_stepper_down() {
        echo '<span class="stepper-arrow down"></span>';
    }

    function pizzahouse_woocommerce_breadcrumb_defaults() {
        return array(
            'delimiter' => '',
            'wrap_before' => '<div class="container"><ul class="breadcrumbs-custom-path">',
            'wrap_after' => '</ul></div>',
            'before' => '<li>',
            'after' => '</li>',
            'home' => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
    }

    function pizzahouse_header_before_breadcrumb() {
        global $redux_config;
        $bg = $redux_config['pizzahouse_single_product_background']['url'];
        ?>
        <section class="bg-gray-7">
            <div class="breadcrumbs-custom box-transform-wrap context-dark">
                <div class="container">
                    <h3 class="breadcrumbs-custom-title"><?php wp_title(''); ?></h3>
                    <div class="breadcrumbs-custom-decor"></div>
                </div>
                <div class="box-transform" style="background-image: url(<?php echo $bg; ?>);"></div>
            </div>
        <?php
    }

    function pizzahouse_header_after_breadcrumb() {
        echo '</section>';
    }

    function pizzahouse_before_single_product() {
        ?>
        <section class="section section-sm section-first bg-default">
            <div class="container">
                <div class="row row-30">
        <?php
    }



    function pizzahouse_after_single_product() {
        ?>
            </div>
        </section>
        <?php
    }

    function pizzahouse_summary_group_price_start() {
        echo '<div class="group-md group-middle">';
    }

    function pizzahouse_div_end() {
        echo '</div>';
    }

    function pizzahouse_summary_rating() {
        global $product;
        $rating_count = $product->get_rating_count();
        $rating_average = $product->get_average_rating();
        ?>
        <!-- Show rating -->
        <div class="product-rating rating-custom single-product-rating">
            <?php echo wc_get_rating_html( $rating_average, $rating_count ); ?>
        </div>
        <?php
    }

    function pizzahouse_quantity_wrapper_open() {
        echo '<div class="stepper">';
    }

    function pizzahouse_single_product_carousel() {
        global $product;
        $main_image = $product->get_image_id();
        $attachment_ids = $product->get_gallery_image_ids();
        array_unshift( $attachment_ids, $main_image );

        ?>
            <div class="col-lg-6">
                <div class="slick-vertical slick-product">
                    <?php if( count( $attachment_ids ) === 0 ): ?>
                    <div class="slick-slider carousel-parent" data-swipe="true" data-items="1" data-child="#child-carousel-6" data-for="#child-carousel-6">
                        <div class="item">
                            <div class="slick-product-figure">
                                <?php
                                    echo wc_placeholder_img();
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- Slick Carousel-->
                    <div class="slick-slider carousel-parent" data-swipe="true" data-items="1" data-child="#child-carousel-6" data-for="#child-carousel-6">
                        <?php foreach( $attachment_ids as $attachment_id ): ?>
                            <div class="item">
                                <div class="slick-product-figure">
                                    <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="slick-slider child-carousel" id="child-carousel-6" data-for=".carousel-parent" data-arrows="true" data-items="3" data-sm-items="3" data-md-items="3" data-lg-items="3" data-xl-items="3" data-slide-to-scroll="1" data-md-vertical="true">
                        <?php foreach( $attachment_ids as $attachment_id ): ?>
                            <div class="item">
                                <div class="slick-product-figure">
                                    <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
    }

//==========================================================
// archive-product.php  Custom template            =========
//========================================================== 


// Remove actions

// Add actions
add_action( 'woocommerce_before_shop_loop', 'pizzahouse_before_shop_loop_wrapper', 15 );
add_action( 'woocommerce_before_shop_loop', 'pizzahouse_div_end', 35 );

function pizzahouse_before_shop_loop_wrapper() {
    echo '<div class="product-top-panel group-md">';
}

//==========================================================
// checkout.php  Custom template                  ==========
//==========================================================

// Add actions
add_action( 'woocommerce_checkout_order_review', 'pizzahouse_checkout_order_review_wrapper_open', 5 );
add_action( 'woocommerce_checkout_order_review', 'pizzahouse_checkout_order_review_wrapper_close', 25 );
add_action( 'woocommerce_before_checkout_form', 'pizzahouse_header_before_breadcrumb', 5 );
add_action( 'woocommerce_before_checkout_form', 'woocommerce_breadcrumb', 6 );
add_action( 'woocommerce_before_checkout_form', 'pizzahouse_header_after_breadcrumb', 7 );

// Remove actions
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

function pizzahouse_checkout_order_review_wrapper_open() { ?>
    <!-- Section Payment-->
    <section class="section section-sm section-last bg-default text-md-left">
        <div class="container">
            <div class="row row-50 justify-content-center">
<?php }

function pizzahouse_checkout_order_review_wrapper_close() { ?>
            </div>
        </div>
    </section>
<?php }

//==========================================================
// thankyou.php  Custom template                   =========
//==========================================================

// Add actions

//==========================================================
// cart.php  Custom template                       =========
//==========================================================

remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
// Remove actions

// Add actions
add_action( 'woocommerce_before_cart', 'pizzahouse_header_before_breadcrumb', 5 );
add_action( 'woocommerce_before_cart', 'woocommerce_breadcrumb', 6 );
add_action( 'woocommerce_before_cart', 'pizzahouse_header_after_breadcrumb', 7 );
add_action( 'woocommerce_before_cart', 'pizzahouse_output_all_notices', 10 );


// AJAX ADD TO CART https://onecommerce.io/blog/ajax-add-to-cart-woocommerce/
//==========================================================
// Ajax add to cart on product page                       ==
//==========================================================

// Remove actions
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

add_action( 'wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart' );    
add_action( 'wp_ajax_product_remove', 'woocommerce_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'woocommerce_ajax_product_remove' );
// Add actions
add_action( 'woocommerce_widget_shopping_cart_buttons', 'pizzahouse_widget_shopping_cart_button_view_cart', 10 );
add_action( 'woocommerce_widget_shopping_cart_buttons', 'pizzahouse_widget_shopping_cart_proceed_to_checkout', 20 );

function pizzahouse_widget_shopping_cart_button_view_cart() {
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward button-primary button-block button-sm button-winona">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
}

function pizzahouse_widget_shopping_cart_proceed_to_checkout() {
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward button-primary button-block button-sm button-winona"><span class="icon mdi mdi-chevron-right"></span>' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
}

function woocommerce_ajax_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        // build cart html
        ob_start();
        woocommerce_mini_cart();
        $mini_cart = ob_get_clean();

        $data = array(
            'cart_totals' => WC()->cart->get_cart_contents_count(),
            'cart_html' => $mini_cart,
            'button_text' => array( 
                'loading' => __( 'Loading...', 'pizzahouse' ), 
                'complete' => __( 'Added!', 'pizzahouse' ) 
            )
        );
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
    }
    echo wp_send_json($data);
    wp_die();
}


// Remove product in the cart using ajax
function woocommerce_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

//==========================================================
// Template display functions                             ==
//==========================================================

// Display page breadcrumb section
function pizzahouse_breadcrumb() {
    pizzahouse_header_before_breadcrumb();
    woocommerce_breadcrumb();
    pizzahouse_header_after_breadcrumb();
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  return 42;
}