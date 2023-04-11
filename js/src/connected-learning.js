


// connected-learning-search functionality
jQuery(document).ready(function($){

	if ( $( ".connected-learning-search" ) ) {
		
		$( ".connected-learning-search-form" ).on( 'submit', function(){
			event.preventDefault();
			var term = $( ".connected-learning-search-term" ).val();

			$.ajax( "/wp-json/wooster/v1/connections/?filter_term=" + encodeURIComponent( term ) ).done(function( data ) {

				console.log( data );

				// clear existing area results (except the 'all' option)
				$( ".result-box.areas li:not(.all)" ).remove();

				// set up an empty result variable
				var areas_results = '';

				// loop through the area of study results
				$.each( data.areas , function( area_key, area_val ){

					// set a result
					areas_results += '<li><a href="'+ area_val.permalink + '">' + area_val.post_title + '</a></li>';

				});

				// set the areas of study results.
				$( ".result-box.areas ul" ).prepend( areas_results );

				// if we have experiential learning results
				if ( data.experiential[0] ) {

					// set the experiential learning item's title and href
					$( ".result-box.experiential li a" ).html( data.experiential[0]['post_title'] ).attr( 'href', data.experiential[0]['permalink'] );

					// if we have an experiential learning post thumbnail
					if ( data.experiential[0]['thumbnail'] != 'false' ) {

						// set the background-image
						$( ".result-box.experiential" ).css( 'background-image', 'url('+data.experiential[0]['thumbnail']+')' );

					}
				}

				// if we have independent study results
				if ( data.experiential[0] ) {

					// set the independent study item's title and href
					$( ".result-box.independent li a" ).html( data.independent[0]['post_title'] ).attr( 'href', data.independent[0]['permalink'] );

					// if we have an independent study post thumbnail
					if ( data.independent[0]['thumbnail'] != 'false' ) {

						// set the background-image
						$( ".result-box.independent" ).css( 'background-image', 'url('+data.independent[0]['thumbnail']+')' );

					}

				}

				// set news result
				if ( data.news[0] ) {

					// set the title and href of the news item
					$( ".result-bar.news .content a" ).html( data.news[0]['post_title'] ).attr( 'href', data.news[0]['permalink'] );

					// if we have a news post thumbnail
					if ( data.news[0]['thumbnail'] != 'false' ) {

						// set the background-image
						$( ".result-bar.news .image" ).css( 'background-image', 'url('+data.news[0]['thumbnail']+')' );
					}

				}
				
				// set profile result
				if ( data.alumni[0] ) {

					// set the alumni profile title and href
					$( ".result-bar.profile .content a" ).html( data.alumni[0]['post_title'] ).attr( 'href', data.alumni[0]['permalink'] );

					// if we have an alumni profile post thumbnail
					if ( data.alumni[0]['thumbnail'] != 'false' ) {

						// set the background-image
						$( ".result-bar.profile .image" ).css( 'background-image', 'url('+data.alumni[0]['thumbnail']+')' );

					}
				}

				// display all the results
				$( ".connected-learning-results" ).slideDown( 500 );

			});
		});

	}

});


