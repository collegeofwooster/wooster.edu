

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	// if there are boxes on the page
	if ( $( '.boxes' ).length ) {

		// when someone clicks a box
		$('.boxes .abox').click(function(){

			// store the link url
			var href = $(this).data('href');

			// if the href data attribute isn't empty
			if ( href.length > 0 ) {
				
				// change the current location.href
				location.href = href;

			};

		});
	}

});

