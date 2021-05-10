

// onload responsive footer and menu stuff
jQuery(document).ready(function($){


	// remove height and width from images inside
	var fluid_images = $( '.content img' );
	fluid_images.removeAttr( 'width' ).removeAttr( 'height' );


	// couple of quick bindings for magnific popup
	$( '.lightbox-iframe' ).magnificPopup({ 'type': 'iframe' });
	$( '.lightbox' ).magnificPopup({ 'type': 'image' });


});

