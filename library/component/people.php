<?php 

$people_cat = get_sub_field( 'people_category' );

print do_shortcode( '[people category="' . $people_cat . '" /]' ); 

