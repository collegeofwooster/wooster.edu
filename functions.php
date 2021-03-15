<?php


// removing this constant will mess up any modules that add to the theme options dashboard area.
define( 'PURE', true );


// set cmb_prefix
define( 'CMB_PREFIX', '_p_' );


// colors array, for use in metaboxes
global $colors;
$colors = array(
	'red' => 'Red',
	'gold' => 'Gold',
	'rose' => 'Rose',
	'sky' => 'Sky',
	'blue' => 'Blue',
	'foam' => 'Seafoam',
	'tan' => 'Tan',
	'grey-dark' => 'Grey (Dark)',
	'grey-light' => 'Grey (Light)',
);


// require multiple - a little helper function to require multiple files from the library directory in a one 
function require_multi( $files ) {
    $files = func_get_args();
    foreach ( $files as $file )
        require_once 'library/' . $file . '.php';
}


// include utility functions
require_multi( 'core', 'admin', 'metabox', 'emergency', 'images', 'paginate', 'metabox', 'showcase', 'featured-article', 'button', 'accordion' );


require_multi( 'post-type/people', 'post-type/area' );


// require composer autoload
require_once 'vendor/autoload.php';

