const { __, _x, _n, sprintf } = wp.i18n;

(function ($) {

    $( document ).on( 'click', '.single_add_to_cart_button', function(e) {
        e.preventDefault();

        $thisbutton = $(this),
        $form =$thisbutton.closest('form.cart'),
        id = $thisbutton.val(),
        product_qty= $form.find('input[name=quantity]').val() || 1,
        product_id = $form.find('input[name=product_id]').val() || id,
        variation_id = $form.find('input[name=variation_id]').val() || 0;
        
        var data = {
        
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };
        
        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
        
        $.ajax({
        
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
                $thisbutton.text('');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
                $thisbutton.text( __( 'Added!', 'pizzahouse' ) );
            },
            success: function (response) {
                if ( response.error & response.product_url ) {
                    window.location = response.product_url;
                    return;
                } else {
                    $('#header-cart-totals').text( response.cart_totals );
                    $('.widget_shopping_cart_content').html( response.cart_html );
                    $(document.body).trigger('added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ]);
                }
            },
        });
            
        return false;    
    });

    // add classes to button generated by woocommerce
    $(document).on('wc_cart_button_updated', function(e, r){
        r.parent().find(".added_to_cart").addClass('button button-xs button-primary button-winona');
    });

    // refresh the cart count items number
    $(document).on('wc_fragments_loaded', function(){
        $('#header-cart-totals').text( 
            $('#woocommerce-cart-items-count').text() == '' ? '0' : $('#woocommerce-cart-items-count').text() 
        );
    })

})(jQuery);