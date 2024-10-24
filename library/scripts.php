<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js?v=21', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );




// hooks your functions into the correct filters
function btn_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
		return;
	}

	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_buttons', 'btn_register_mce_button' );
	}
}
add_action('init', 'btn_add_mce_button');


// register new button in the editor
function btn_register_mce_button( $buttons ) {
	array_push( $buttons, 'superscript' );
	//array_push( $buttons, 'btn_mce_button' );
	return $buttons;
}
