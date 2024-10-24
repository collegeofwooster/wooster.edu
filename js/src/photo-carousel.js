

// onload
jQuery(document).ready(function($){

	// grab the carousel
	$( '.photo-carousel-container' ).each(function(){
		var carousel_container = $( this );

        var carousel = carousel_container.find( '.photo-carousel' );

		// set auto-rotate timer var so that it exists.
		var auto_rotate = 0;

		// get the photos
		var photos = carousel.find('.photo');

		// count the photos
		var photo_count = photos.size();

		// if it exists
		if ( typeof( carousel ) !== 'undefined' ) {

			// grab the first photo
			var first_photo = photos.first();
			first_photo.addClass('visible');

			// grab the last photo
			var last_photo = photos.last();

			// function to switch to the previous photo
			var prev_photo = function() {

				// get current and next photo objects
				var current_photo = get_current_photo();
				var prev_photo = current_photo.prev(".photo");

				// if next photo doesn't exist, go back to the first
				if ( !prev_photo.length ) {
					prev_photo = last_photo;
				}

				// switch the photos
				current_photo.removeClass( 'visible' );
				prev_photo.addClass( 'visible' );

			};
			

			// function to switch to the next side.
			var next_photo = function() {

				// get current and next photo objects
				var current_photo = get_current_photo();
				var next_photo = current_photo.next( '.photo' );

				// if next photo doesn't exist, go back to the first
				if ( !next_photo.length ) {
					next_photo = first_photo;
				}

				// switch the photo
				current_photo.removeClass( 'visible' );
				next_photo.addClass( 'visible' );
			};


			// grab the current photo
			var get_current_photo = function(){
				return carousel.find( '.photo.visible' );
			};


			// set carousel initial height when the first image is loaded.
			setTimeout( function() {
				// once we're loaded up, set a timer to auto-rotate the photos.
				if ( photo_count > 1 ) {
					auto_rotate = setInterval( next_photo, 10000 );
				}
			}, 500 );


			// next/previous click
			carousel_container.find( '.controls a' ).click(function( event ){
                event.preventDefault()

				if ( $(this).hasClass( 'prev' ) ) {
					prev_photo();
				} else {
					next_photo();
				}

				// stop auto-rotation
				if ( photo_count > 1 ) {
					clearInterval( auto_rotate );
				}
			});

		}

	});


});

