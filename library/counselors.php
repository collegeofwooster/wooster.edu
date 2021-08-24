<?php


function counselors_shortcode() {
	return '<iframe src="' . get_bloginfo('template_url') . '/library/counselors/index.php" class="counselor-map"></iframe>';
}
add_shortcode( 'counselors-map', 'counselors_shortcode' );


