<?php


function counselor_search_shortcode() {
	$counselors = <<<EOD
<div class="counselor-search-container">
	<form class="counselor-search-form" action="/admission/counselors/"><label for="zip-search">ZIP Code: <input name="zip-search" class="zip-search" type="text"></label><input type="submit" value="Search"></form>
</div>
EOD;
	return $counselors;
}
add_shortcode( 'counselor-search', 'counselor_search_shortcode' );

