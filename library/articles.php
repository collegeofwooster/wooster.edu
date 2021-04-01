<?php


// articles shortcode
function articles_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'style' => "card",
		'tags' => '',
		'cats' => ''
	), $atts );

	

	$return = '';
	if ( !empty( $a['url'] ) ) {
		if ( !empty( $a['container'] ) ) {
			$return .= '<div class="buttons">';
		}
		$return .= '<a href="' . $a['url'] . '" class="btn ' . $a['class'] . '" target="' . $a['target'] . '"' . ( !empty( $a['download'] ) ? ' download="' . $a['download'] . '"' : '' ) . '>' . $content . '</a>';
		if ( !empty( $a['container'] ) ) {
			$return .= '</div>';
		}
		return $return;
	}

}
add_shortcode( 'articles', 'articles_shortcode' );

