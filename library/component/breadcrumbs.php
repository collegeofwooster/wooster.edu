<?php

// get page ancestors
$ancestors = get_post_ancestors( get_the_ID() );

// get ancestor info
$crumbs = array();
if ( !empty( $ancestors ) ) {
    foreach ( $ancestors as $anc ) {
        $crumbs[] = get_page( $anc );
    }
}

// reverse the order of the ancestors in the crumbs
$crumbs = array_reverse( $crumbs );

// empty string to start from
$crumb_code = '';

// if the ancestor array isn't empty, compile crumb code
if ( !empty( $crumbs ) ) {

    // loop through the crumbs
    foreach ( $crumbs as $crumb ) {
        $crumb_code .= "<a href='" . get_permalink( $crumb->ID ) . "'>" . $crumb->post_title . "</a> &raquo; ";
    }
}

print $crumb_code;

