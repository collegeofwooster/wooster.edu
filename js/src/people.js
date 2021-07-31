

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

});

