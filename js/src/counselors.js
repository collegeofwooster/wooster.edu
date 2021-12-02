

jQuery( document ).ready( function( $ ) {

	// watch for a counselor search form submission
	$('.counselor-search-form').submit(function(){

		// prevent the form from actually going to the action url
		event.preventDefault();

		// get the zip from the field
		var zipcode = $( '.zip-search' ).val();

		// get the zip query page content which contains the counselor object
		$.get( "/wp-content/themes/wooster/library/counselors/adm-zip-query.php?zip=" + zipcode, function( result ) {
			console.log( result );
		} );

	});
	
});

