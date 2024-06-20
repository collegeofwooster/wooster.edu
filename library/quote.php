<?php


// a quote shortcode
function quote_shortcode( $atts, $content = null ) {

	// default settings
	$a = shortcode_atts( array(
		'by' => false,
		'photo' => false,
		'style' => 'left'
	), $atts );

	$return = '';

	// if we have content and an attribution
	if ( !empty( $a['by'] ) && !empty( $content ) ) {
		
		// start the quote block	
		$return .= '<div class="quote ' . $a['style'] . '">';

		// if we have a photo
		if ( $a['photo'] ) {
			$return .= '<div class="quote-photo"><img src="' . $a['photo'] . '" /></div>';
		}

		// add the quote content and by line
		$return .= '<div class="quote-content"><div class="quote-content-inner">' . $content . '</div><div class="quote-attribution">' . $a['by'] . '</div></div>';
		
		// close the quote
		$return .= '</div>';

		return $return;
	}
	
}
add_shortcode( 'quote', 'quote_shortcode' );

