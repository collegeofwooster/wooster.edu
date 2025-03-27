<?php 

$people_cat = get_sub_field( 'people_category' );
$search = get_sub_field( 'search' );

print do_shortcode( '[people category="' . $people_cat . '" search="' . ( $search ? 1 : 0 ) . '" /]' ); 

