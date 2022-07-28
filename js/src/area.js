

// Read a page's GET URL variables and return them as an associative array.
var getUrlVars = function() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}



// area controls
jQuery(document).ready(function($){


	// set faculty photo height to same as width
	var set_photo_height = function() {
		$( '.area-faculty .photo' ).height( $( '.area-faculty .photo' ).width() );
	}


	// back to main areas list?
	$( '.back-to-areas' ).click(function(){
		location.href = "/areas-of-study";
	});


	// handle clicks on the tab-nav items
	$( '.area .tab-nav li' ).on( 'click', function(){

		// remove active class from main item
		$( '.area .tab-nav li.active' ).removeClass( 'active' );

		// get class of clicked tab
		var tab_class = $(this).attr( 'class' );

		// set clicked tab to 'active'
		$(this).addClass( 'active' );

		// hide visible content divs
		$( '.area .tab-content:visible' ).removeClass( 'active' );

		// get content div based on that class
		$( '.area .tab-content.'+tab_class ).addClass( 'active' );

		// set faculty photo height equal to width.
		set_photo_height();

	});


	// if we're in the tab area
	if ( $('.area').length > 0 ) {

		// set some initial variables on load.
		var area_top = $( '.area' ).offset();

		// update values when the window resizes.
		$( window ).on( 'resize', function(){

			// get the area offset.top
			area_top = $( '.area' ).offset();

			// resize faculty photo div.
			set_photo_height();
			
		});

		// when the page scrolls
		$( window ).on( 'scroll', function(){

			// get the scroll position
			var scroll_position = $( window ).scrollTop();

			// if we're on the applicable screen size.
			if ( $( window ).innerWidth() >= 768 ) {

				// if we're scrolled past the top of the area div
				if ( scroll_position > area_top.top ) {

					// tell the nav we're scrolled
					$( '.area .tab-nav' ).addClass( 'scrolled' );

				} else {

					// otherwise remove the scrolled class
					$( '.area .tab-nav' ).removeClass( 'scrolled' );

				}

			}

		});


		// get the query vars
		var query_vars = getUrlVars();

		// onload switch tabs
		if ( typeof( query_vars['tab'] ) !== 'undefined' ) {

			// hide visible content divs
			$( '.area .tab-content:visible' ).removeClass( 'active' );

			// get content div based on that class
			$( '.area .tab-content.area-'+query_vars['tab'] ).addClass( 'active' );
			
		}


		// set faculty photo height equal to width.
		set_photo_height();
	}


	// handle area filtering on the main areas-of-study page
	if ( $('.area-listing').length > 0 ) {

		// store some sections of the page
		var area_list = $('.area-listing');
		var area_filter = $('.area-filter select');

		// function to reset the list if they choose 'all'
		var reset_list = function(){
			area_list.find('.area').show();
		}

		// area filter select list change
		area_filter.on( 'change', function(){

			// reset the listing
			reset_list();

			// get the filter value
			var filter_value = $(this).val();

			// if they choose all.
			if ( $(this).val() != 'all' ) {

				// loop through and hide all items that don't fit the filter
				area_list.find( '.area:not(.'+filter_value+')' ).each(function(){
					$(this).hide();
				});
			}

		});

	}
	
});

