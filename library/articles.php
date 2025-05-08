<?php


// articles shortcode
function articles_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'style' => "card",
		'tags' => '',
		'cats' => '',
		'cat' => '',
		'tag' => '',
		'posts_per_page' => 4
	), $atts );

	$args = array(
		'posts_per_page' => $a['posts_per_page']
	);

	// 'tag' takes slug
	if ( !empty( $a['tag'] ) ) {
		$args['tag'] = $a['tag'];
	}

	// 'tags' takes ids
	if ( !empty( $a['tags'] ) ) {
		$tags = explode( ',', $a['tags'] );
		$args['tag__in'] = $tags;
	}

	// 'cat' takes slug
	if ( !empty( $a['cat'] ) ) {
		$args['category_name'] = $a['cat'];
	}

	// 'cats' takes id
	if ( !empty( $a['cats'] ) ) {
		$cats = explode( ',', $a['cats'] );
		$args['category__in'] = $cats;
	}

	$query = new WP_Query( $args );

	// Check that we have query results.
	if ( $query->have_posts() ) {

		$return = '<div class="' . ( $a['style'] == 'list' ? 'article-list' : 'article-cards' ) . '">';
	  
	    // Start looping over the query results.
	    while ( $query->have_posts() ) {
	        $query->the_post();
	        $return .= '<div class="entry">';
	        $return .= '<div class="entry-thumbnail"><a href="' . get_the_permalink() . '">';
	        $return .= get_the_post_thumbnail( null, 'post-thumbnail' );
	        $return .= '</a></div>';
	        $return .= '<div class="entry-inner">';
		    $return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
		    $return .= '<div class="excerpt">' . wpautop( get_the_excerpt() ) . '</div>';
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


// limit the number of words in the excerpt.
function custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



add_action( 'pre_get_posts', 'woo_pre_get_posts' );
function woo_pre_get_posts( $query ){

	// if it's the main query for posts
	if ( $query->is_main_query() ) {

		// exclude the set of categories
		$query->set( 'category__not_in', get_field( 'exclude', 'option' ) );
		
	}
}