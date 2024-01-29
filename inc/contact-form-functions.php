<?php 

add_action( 'wpcf7_init', 'custom_add_form_tag_hint' );

function custom_add_form_tag_hint() {
    wpcf7_add_form_tag( 'hint', 'custom_hint_form_tag_handler' ); // "clock" is the type of the form-tag
}
    
function custom_hint_form_tag_handler( $tag ) {
    global $redux_config;
    if( empty( $redux_config['pizzahouse_contact_form_hint'] ) )
        return '';
    return $redux_config['pizzahouse_contact_form_hint'];
}

?>