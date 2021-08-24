<?php


function counselors_shortcode() {
	$counselors = <<<EOD
<script>
jQuery( document ).ready( function( $ ) {
	$('.counselor-search').submit(function(){
		var zipcode = $('#zip-search').val();
		var result = $.get( "./adm-zip-query.php?q=" + zipcode );
		console.log( result );
	});
});
</script>
<div>
	<p>High School Zip Code: <form class="counselor-search" action="#"><input class="zip-search" type="text"><input type="button" value="Search"></form></p>
</div>
EOD;
	return $counselors;
}
add_shortcode( 'counselors-map', 'counselors_shortcode' );

