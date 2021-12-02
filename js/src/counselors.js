

jQuery( document ).ready( function( $ ) {
	$('.counselor-search-form').submit(function(){
		event.preventDefault();
		var zipcode = $('.zip-search').val();
		var result = $.get( "/wp-content/themes/wooster/library/counselors/adm-zip-query.php?zip=" + zipcode );
		console.log( result );
	});
});

