<?php


// articles shortcode
function articles_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'style' => "card",
		'tags' => '',
		'cats' => ''
	), $atts );

	$args = array(
	    'posts_per_page' => 3
	);

	$tags = explode( ',', $a['tags'] );
	$cats = explode( ',', $a['cats'] );

	if ( !empty($tags) ) {
		$args['tags__in'] = $tags;
	}

	if ( !empty($cats) ) {
		$args['category__in'] = $cats;
	}

	$query = new WP_Query( $args );

	$return = '<div class="article-cards">';

	// Check that we have query results.
	if ( $query->have_posts() ) {
	  
	    // Start looping over the query results.
	    while ( $query->have_posts() ) {
	        $query->the_post();
	        $return .='<div class="entry">';
	        $return .= get_the_post_thumbnail();
	        $return .= '<div class="entry-inner">';
		    $return .= '<h4>' . get_the_title() . '</h4>';
		    $return .= get_the_excerpt();
		    $return .= '</div></div>';
	    }
	  
	} else {
		return '';
	}

	$return .= '</div>';
	  
	// Restore original post data.
	wp_reset_postdata();
	  

	return $return;
}
add_shortcode( 'articles', 'articles_shortcode' );

