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
require_multi( 'core', 'api', 'metabox', 'page-settings', 'showcase', 'featured-article', 'photo-tiles', 'accordion', 'button', 'emergency', 'images', 'articles', 'box', 'boxes', 'statistics', 'is-database/shortcode', 'directory', 'counselors' );


// flush rewrite rules for custom post types when we switch themes
add_action( 'after_switch_theme', 'flush_rewrite_rules' );


// load post types
require_multi( 'post-type/people', 'post-type/area', 'post-type/event', 'post-type/alum', 'post-type/year', 'post-type/org', 'post-type/fund', 'post-type/job' );


// require composer autoload
require_once 'vendor/autoload.php';

