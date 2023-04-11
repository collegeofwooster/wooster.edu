<?php


// get CMB value
function get_cmb_value( $field, $post_id = 0 ) {
    return strip_test_domains( get_post_meta( ( !empty( $post_id ) ? $post_id : get_the_ID() ), CMB_PREFIX . $field, 1 ) );
}


// get CMB value
function has_cmb_value( $field ) {
    $cval = get_cmb_value( $field );
    return ( !empty( $cval ) ? true : false );
}


// get CMB value
function show_cmb_value( $field ) {
    print strip_test_domains( get_cmb_value( $field ) );
}


// get CMB value
function show_cmb_wysiwyg_value( $field, $post=0 ) {
    print apply_filters( 'the_content', get_cmb_value( $field ) );
}

