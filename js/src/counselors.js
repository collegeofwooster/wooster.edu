

jQuery( document ).ready( function( $ ) {

	// watch for a counselor search form submission
	$('.counselor-search-form').submit(function(){

		// prevent the form from actually going to the action url
		event.preventDefault();

		// get the zip from the field
		var zipcode = $( '.zip-search' ).val();

		// get the zip query page content which contains the counselor object
		$.get( "/wp-content/themes/wooster/library/counselors/adm-zip-query.php?zip=" + zipcode, function( result ) {
			
			// parse the result into a usable js object
			var data = JSON.parse( result );

			// if the username isn't empty
			if ( typeof( data.username ) != 'undefined' ) {

				// redirect to the bio page for the counselor in question
				location.href = '/bio/' + data.username;

			} else {

				$('.counselor-search-form').append( '<div class="error">No counselors found.</div>' );

			}

		} );

	});
	
});

