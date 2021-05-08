<?php


// articles shortcode
function articles_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'style' => "card",
		'tags' => '',
		'cats' => '',
		'posts_per_page' => 4
	), $atts );

	$args = array(
		'posts_per_page' => $a['posts_per_page']
	);

	if ( !empty( $a['tag'] ) ) {
		$args['tag'] = $a['tag'];
	}

	if ( !empty( $a['tags'] ) ) {
		$tags = explode( ',', $a['tags'] );
		$args['tag__in'] = $tags;
	}

	if ( !empty($a['cats']) ) {
		$cats = explode( ',', $a['cats'] );
		$args['category__in'] = $cats;
	}

	$query = new WP_Query( $args );

	// Check that we have query results.
	if ( $query->have_posts() ) {

		$return = '<div class="article-cards">';
	  
	    // Start looping over the query results.
	    while ( $query->have_posts() ) {
	        $query->the_post();
	        $return .= '<div class="entry">';
	        $return .= '<div class="entry-thumbnail"><a href="' . get_the_permalink() . '">';
	        $return .= get_the_post_thumbnail( null, 'post-thumbnail' );
	        $return .= '</a></div>';
	        $return .= '<div class="entry-inner">';
		    $return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
		    $return .= wpautop( get_the_excerpt() );
		    $return .= '</div></div>';
	    }

		$return .= '</div>';
	  
	} else {
		return '';
	}
	  
	// Restore original post data.
	wp_reset_postdata();
	  

	return $return;
}
add_shortcode( 'articles', 'articles_shortcode' );

