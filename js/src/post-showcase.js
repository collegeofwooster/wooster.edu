

// onload
jQuery(document).ready(function($){

	// grab the showcase
	$( '.post-showcase' ).each(function(){
		var post_showcase = $( this );

		// set auto-rotate timer var so that it exists.
		var auto_rotate = 0;

		// get the slides
		var post_slides = post_showcase.find('.slide');

		// count the slides
		var slide_count = post_slides.size();

		// if it exists
		if ( typeof( post_showcase ) !== 'undefined' ) {

			// grab the current slide
			var get_current_slide = function(){

				// get the currently visible slide and return it
				return post_showcase.find( '.slide.visible' );

			};


			// a little function to set the height of the showcase based on the current slide image height.
			var set_current_slide_height = function() {

				// get current slide.
				var current_slide = get_current_slide();

				// current slide height
				var current_slide_height = current_slide.find( 'img' ).css('height');

				// get the current slide image height and set the overall showcase height based on it.
				post_showcase.height( current_slide_height );

			};


			// grab the first slide
			var first_slide = post_slides.first();

			// add visible class to first slide.
			first_slide.addClass('visible');

			// set the currently visible slides height.
			setTimeout( function(){
				set_current_slide_height();
			}, 500 );

			// grab the last slide
			var last_slide = post_slides.last();


			// function to switch to the previous slide
			var prev_slide = function() {

				// get current and next slide objects
				var current_slide = get_current_slide();
				var prev_slide = current_slide.prev(".slide");

				// if next slide doesn't exist, go back to the first
				if ( !prev_slide.length ) {
					prev_slide = last_slide;
				}

				// switch the slides
				current_slide.removeClass( 'visible' );
				prev_slide.addClass( 'visible' );

				// set the current slide height
				set_current_slide_height();

			};
			

			// function to switch to the next side.
			var next_slide = function() {

				// get current and next slide objects
				var current_slide = get_current_slide();
				var next_slide = current_slide.next( '.slide' );

				// if next slide doesn't exist, go back to the first
				if ( !next_slide.length ) {
					next_slide = first_slide;
				}

				// switch the slides
				current_slide.removeClass( 'visible' );
				next_slide.addClass( 'visible' );

				// set the current slide height
				set_current_slide_height();

			};


			// set showcase initial height when the first image is loaded.
			setTimeout( function() {
				// once we're loaded up, set a timer to auto-rotate the slides.
				if ( slide_count > 1 ) {
					auto_rotate = setInterval( next_slide, 10000 );
				}
			}, 500 );


			// next/previous click
			post_showcase.find( '.showcase-nav a' ).click(function(){
				if ( $(this).hasClass( 'previous' ) ) {
					prev_slide();
				} else {
					next_slide();
				}

				// stop auto-rotation
				if ( slide_count > 1 ) {
					clearInterval( auto_rotate );
				}
			});

		}

	});

});

