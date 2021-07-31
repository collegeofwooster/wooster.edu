<?php 


function box( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'color' => 'gold',
		'title' => 'Box Title'
	), $atts ) );

	$box = '<div class="box ' . $color . '">';
	$box .= '<div class="box-title">' . $title . '</div>';
	$box .= '<div class="box-content">' . apply_filters( 'the_content', $content ) . '</div>';
	$box .= '</div>';

	return $box;

}
add_shortcode( 'box', 'box' );

