<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js?v=17', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );


// register new button in the editor
function btn_register_mce_button( $buttons ) {
	array_push( $buttons, 'superscript' );
	//array_push( $buttons, 'btn_mce_button' );
	return $buttons;
}
