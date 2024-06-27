<?php


// flexcol shortcode
function flexcol_shortcode( $atts, $content = null ) {

	// default settings
	$a = shortcode_atts( array(
		'reverse' => false,
		'row' => 'all',
	), $atts );
		
    // start the quote block	
    return '<div class="flexcol' . ( $a['reverse'] ? ' reverse' : '' ) . ' ' . $a['row'] . '">' . do_shortcode( $content ) . '</div>';
    	
}
add_shortcode( 'flexcol', 'flexcol_shortcode' );


// cols inside flexcol shortcode
function col_shortcode( $atts, $content = null ) {

	// default settings
	$a = shortcode_atts( array(
		'style' => 'normal',
		'title' => '',
	), $atts );
		
    // start the quote block
    return '<div class="col ' . $a['style'] . '">' . 
		( !empty( $a['title'] ) ? '<div class="col-title">' . $a['title'] . '</div>' : '' ) . 
		'<div class="col-content">' . do_shortcode( clean_p( $content ) ) . '</div>' . 
		'</div>';
	
}
add_shortcode( 'col', 'col_shortcode' );


function clean_p( $content = '' ) {
	if ( substr( $content, 0, 4 ) == '</p>' ) {
		$content = substr( $content, 4 );
	}
	if ( substr( $content, strlen( $content )-3 ) == '<p>' ) {
		$content = substr( $content, 0 , strlen( $content )-3 );
	}
	return $content;
}