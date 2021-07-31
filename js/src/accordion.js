


jQuery(document).ready(function($){

	if ( $( '.accordion' ).length > 0 ) {
		$( '.accordion-handle' ).click(function(){
			$( this ).parent('.accordion').toggleClass( 'open' );
		});
	}

});


