<?php

function pdf_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'src' => '',
	), $atts );

	$return = '';
	if ( !empty( $a['src'] ) ) {
        return '<div class="pdf-frame"><iframe src="' . $a['src'] . '"></iframe></div>';
	}
}
add_shortcode( 'pdf-iframe', 'pdf_shortcode' );


