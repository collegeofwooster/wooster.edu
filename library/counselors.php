<?php


function counselor_search_shortcode() {
	$counselors = <<<EOD
<div class="counselor-search-container">
	<p>ZIP Code: <form class="counselor-search-form" action="/admission/counselors/"><input class="zip-search" type="text"><input type="submit" value="Search"></form></p>
</div>
EOD;
	return $counselors;
}
add_shortcode( 'counselor-search', 'counselor_search_shortcode' );

