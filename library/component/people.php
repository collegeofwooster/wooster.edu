<?php 

$people_cat = get_sub_field( 'people_category' );
$search = get_sub_field( 'search' );
$lightbox = get_sub_field( 'lightbox-bios' );


print do_shortcode( '[people category="' . $people_cat . '" search="' . ( $search ? 1 : 0 ) . '" style="' . ( $lightbox ? 'lightbox' : 'grid' ) . '" /]' ); 

