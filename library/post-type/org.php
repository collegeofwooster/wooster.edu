<?php



// let's create the function for the custom type
function org_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'org', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Student Orgs', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Org', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Orgs', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Org', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Org', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Org', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Org', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Orgs', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage student orgs.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-beer', /* the icon for the custom post type menu */
			'rewrite'	=> array( 
				'slug' => 'org', 
				'with_front' => false 
			), /* you can specify its url slug */
			'has_archive' => 'orgs', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'org' );
	
}


// adding the function to the Wordpress init
add_action( 'init', 'org_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'org_cat', 
	array('org'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Org Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Org Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Org Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All Org Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Org Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Org Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Org Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Org Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Org Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Org Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 
			'slug' => 'org-category'
		)
	)
);


// get a list of the orgs categories
function get_org_categories() {
	$terms = get_terms( 'org_cat' );
	return $terms;
}


// the 'orgs' shortcode
function orgs_shortcode( $atts ) {

	// remove wpautop
	remove_filter( 'the_content', 'wpautop' );

	// set default params and override with those in shortcode
	extract( shortcode_atts( array(
		'category' => '',
		'show_title' => true
	), $atts ));

	$args = array(
		'post_type' => 'org',
		'org_cat' => $category,
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => '-1'
	);
	$query = new WP_Query( $args );

	// get the category info so we have the title
	$cat_info = get_term_by( 'slug', $category, 'org_cat' );

	// if there are orgs
	if ( $query->have_posts() ) {

		// start the org listing
		$orgs_list = '';

		// add org category title
		if ( $show_title ) {
			$orgs_list .= '<h3>' . $cat_info->name . '</h3>';
		}

		// open the list tag
		$orgs_list .= '<ul class="org-list">';

		// loop through the results
		while ( $query->have_posts() ) : $query->the_post();

			// add to the list
			$orgs_list .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';

		endwhile;

		// stop the org listing
		$orgs_list .= '</ul>';
	}

	// apply filters first
	$orgs_list = apply_filters( 'the_content', $orgs_list );

	// add back wpautop
	add_filter( 'the_content', 'wpautop' );

	// send the orgs list back to display
	return $orgs_list;

}
add_shortcode( 'orgs', 'orgs_shortcode' );

