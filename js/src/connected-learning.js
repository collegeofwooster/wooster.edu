


// connected-learning-search functionality
jQuery(document).ready(function($){

	if ( $( ".connected-learning-search" ) ) {
		
		$( ".connected-learning-search-form" ).on( 'submit', function(){
			event.preventDefault();
			var term = $( ".connected-learning-search-term" ).val();

			$.ajax( "/wp-json/wooster/v1/connections/?filter_term=" + encodeURIComponent( term ) ).done(function( data ) {
				// set areas results
				$( ".result-box.areas li:not(.all)" ).remove();
				var areas_results = '';
				$.each( data.areas , function( area_key, area_val ){
					areas_results += '<li><a href="'+ area_val['permalink'] + '">' + area_val['post_title'] + '</a>"';
				});
				$( ".result-box.areas ul" ).prepend( areas_results );

				// set areas results
				/*
				$( ".result-box.pathways li:not(.all)" ).remove();
				var pathways_results = '';
				$.each( data.pathways , function( pathway_key, pathway_val ){
					pathways_results += '<li><a href="'+ pathway_val['permalink'] + '">' + pathway_val['post_title'] + '</a>"';
				});
				$( ".result-box.pathways ul" ).prepend( pathways_results );
				*/

				// set experiential learning result
				$( ".result-box.experiential li a" ).html( data.experiential[0]['post_title'] ).attr( 'href', data.experiential[0]['permalink'] );
				
				// set independent study result
				$( ".result-box.independent li a" ).html( data.independent[0]['post_title'] ).attr( 'href', data.independent[0]['permalink'] );
				
				// set news result
				$( ".result-bar.news li a" ).html( data.news[0]['post_title'] ).attr( 'href', data.news[0]['permalink'] );
				
				// set profile result
				$( ".result-bar.profile li a" ).html( data.profile[0]['post_title'] ).attr( 'href', data.profile[0]['permalink'] );

				$( ".connected-learning-results" ).slideDown( 500 );
			});
		});

	}

});


