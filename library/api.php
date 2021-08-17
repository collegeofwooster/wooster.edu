<?php


// add acceptable query vars so they don't get filtered by WP
function add_query_vars_filter( $vars ){
	$vars[] = "filter_term";
	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function wooster_api_connections( $data ) {

	// dump the request parameters
	$url_parts = explode( "?", $_SERVER['REQUEST_URI'] );
	parse_str( $url_parts[1], $request );
	
	// empty object to fill before returning
	$return = new stdClass;

	// get the area of study info
	$return->areas = get_posts(array(
		'post_type' => 'area',
		//'s' => $request['filter_term'],
		//'search_prod_title' => $request['filter_term'],
		'posts_per_page' => 5,
		'tag' => str_replace( ' ', ',', $request['filter_term'] ),
		'orderby' => 'title',
		'order' => 'ASC',
	));
	foreach ( $return->areas as $area_key=>$area ) {
		$return->areas[$area_key]->permalink = get_permalink( $area->ID );
		$return->areas[$area_key]->thumbnail = get_the_post_thumbnail_url( $area->ID );
	}

	// get the experiential learning posts
	$return->experiential = get_posts(array(
		'post_type' => 'post',
		's' => $request['filter_term'],
	    'category' => 792,
		'posts_per_page' => 1
	));
	if ( !empty( $return->experiential ) ) {
		$return->experiential[0]->permalink = get_permalink( $return->experiential[0]->ID );
		$return->experiential[0]->thumbnail = get_the_post_thumbnail_url( $return->experiential[0]->ID );
	}

	// get the independent studies from posts
	$return->independent = get_posts(array(
		'post_type' => 'post',
		's' => $request['filter_term'],
	    'category' => 793,
		'posts_per_page' => 1
	));
	if ( !empty( $return->independent ) ) {
		$return->independent[0]->permalink = get_permalink( $return->independent[0]->ID );
		$return->independent[0]->thumbnail = get_the_post_thumbnail_url( $return->independent[0]->ID );
	}

	// get the news from posts
	$return->news = get_posts(array(
		'post_type' => 'post',
		's' => $request['filter_term'],
		'category' => 794,
		'posts_per_page' => 1
	));
	if ( !empty( $return->news ) ) {
		$return->news[0]->permalink = get_permalink( $return->news[0]->ID );
		$return->news[0]->thumbnail = get_the_post_thumbnail_url( $return->news[0]->ID, array( 200, 200 ) );
	}

	// get the alumni profiles from posts
	$return->alumni = get_posts(array(
		'post_type' => 'post',
		's' => $request['filter_term'],
	    'category' => 791,
		'posts_per_page' => 1
	));
	if ( !empty( $return->alumni ) ) {
		$return->alumni[0]->permalink = get_permalink( $return->alumni[0]->ID );
		$return->alumni[0]->thumbnail = get_the_post_thumbnail_url( $return->alumni[0]->ID, array( 200, 200 ) );
	}

	return $return;

}


add_action( 'rest_api_init', function () {
	register_rest_route( 'wooster/v1', '/connections/', array(
		'methods' => 'GET',
		'callback' => 'wooster_api_connections'
	) );
} );


// a simple function to parse the query string of the URL
function parse_query_string() {

	// separate the parts of the URL
	$url_parts = explode( "?", $_SERVER['REQUEST_URI'] );

	// parse the query string part into an array.
	parse_str( $url_parts[1], $request );

	// return it
	return $request;
}