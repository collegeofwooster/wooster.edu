<?php


// the directory shortcode
function directory_shortcode() {

	// get the table code 
	$directory_table_code = file_get_contents( "https://api.wooster.edu/directory/index.php" );

	// return it
	return $directory_table_code;

}
add_shortcode( 'directory', 'directory_shortcode' );


