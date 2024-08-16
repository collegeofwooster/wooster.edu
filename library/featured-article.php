<?php


// function to use on front-end templates to output the showcase.
function the_featured_article() {

	// get the featured article
	$article_id = get_cmb_value( 'featured_article' );
	$article = get_post( $article_id );

	?>
	<div class="featured-article">
		<div class="featured-article-image">
			<img src="<?php print get_the_post_thumbnail_url( $article_id, 'thumbnail' ); ?>" />
		</div>
		<div class="featured-article-content">
			<h4>Featured</h4>
			<h3><a href="<?php print get_permalink( $article_id ) ?>"><?php print $article->post_title; ?></a></h3>
			<?php print do_shortcode('[button url="' . get_permalink( $article_id ) . '" class="black"]Read more[/button]') ?>
		</div>
	</div>
	<?php
}



// add the showcase metabox
function featured_article_metabox( $meta_boxes ) {

	// get all the articles and manipulate for the
	$all_posts = get_posts( array(
		'numberposts' => -1
	));

	// go through posts
	$post_list = array();
 	foreach ( $all_posts as $post ) {
 		$post_list[$post->ID] = $post->post_title . " (" . date( 'n/j/Y', strtotime( $post->post_date ) ) . ")";
 	}

	// set up the metabox
    $featured_article_metabox = new_cmb2_box( array(
        'id' => 'featured_article_metabox',
        'title' => 'Featured Article',
        'object_types' => array( 'page' ), // post type
        'show_on' => array( 
        	'key' => 'page-template', 
        	'value' => 'page-front.php'
        ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $featured_article_metabox->add_field( array(
        'name' => 'Featured Article',
        'id'   => CMB_PREFIX . 'featured_article',
        'type' => 'select',
        'options' => $post_list
    ) );

}
add_filter( 'cmb2_init', 'featured_article_metabox' );


