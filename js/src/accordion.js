


jQuery(document).ready(function($){

	if ( $( '.accordion' ).length > 0 ) {
		$( '.accordion-handle' ).click(function(){
			console.log( $(this).parent('.accordion') );
			$( this ).parent('.accordion').toggleClass( 'open' );
		});
	}

});


