

jQuery.expr[':'].icontains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};


// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	if ( $( '.people-search' ) ) {
		$( '.people-search input[type=text]' ).on( 'keyup', function(){
			$( '.person-entry').addClass('visible');
			$( ".person-entry:not(:icontains('" + $(this).val() + "'))" ).removeClass('visible');
		});
	}


	// handle lightbox bio people style.
	$('.person-bio-link').click( function(){

		var person_div_sel = '#'+$(this).attr( 'rel' );
		var popup_content = $( person_div_sel ).html();
		console.log( popup_content );

		// open a magnific popup with the bio
		$.magnificPopup.open({
			items: {
				src: popup_content
			},
			type: 'inline'
		});

	});


});

