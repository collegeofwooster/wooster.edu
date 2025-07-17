<?php


// let's create the function for the custom type
function people_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'people', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'People', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'People', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All People', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Person', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Person', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Person', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View People', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search People', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'No people found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'No people found in trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the people with bios on the site.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-businessperson', /* the icon for the custom post type menu */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'bio'
			),
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'people' );
	
}


// adding the function to the Wordpress init
add_action( 'init', 'people_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'people_cat', 
	array('people'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true, /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'People Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'People Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search People Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All People Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent People Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent People Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit People Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update People Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New People Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New People Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 
			'slug' => 'people'
		)
	)
);



function list_people_category( $category ) {

	// set up some args
	$args = array( 
		'post_type' => 'people', 
		'posts_per_page' => 999, 
		'orderby' => 'title', 
		'order' => 'ASC', 
		'tax_query' => array( 
			array(
				'taxonomy' => 'People_cat',
				'field' => 'slug',
				'terms' => $category
			) 
		) 
	);

	$show_links = true;

	// check if it's the beyond ripon page
	if ( is_page( 'beyond-ripon' ) ) {
		// don't link the items if it's that
		$show_links = false;
	}

	// grab category information
	$category_info = get_term_by( 'slug', $category, 'people_cat' );

	// start up a loop
	$loop = new WP_Query( $args );

	?>
	<h3><?php print $category_info->name ?></h3>
	<ul>
	<?php
	// loop through the post results
	while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<li><?php if ( $show_links ) { ?><a href="<?php the_permalink() ?>"><?php } ?><?php the_title(); ?><?php if ( $show_links ) { ?></a><?php } ?></li>
		<?php
	endwhile;
	?>
	</ul>
	<?php
	
	// reset the post data
	wp_reset_postdata();

}


function get_person_categories( $person_id = '' ) {

	// if the person id is empty, set it from the post info
	if ( empty( $person_id ) ) $person_id = get_the_ID();

	// return the people cats
	return wp_get_post_terms( $person_id, 'people_cat' );

}


// takes a person ID and category slug, and returns boolean of whether or not the person is in that people_cat
function is_person_in_category( $person_id = '', $person_category=0 ) {
	
	// set the person id if it's empty
	if ( empty( $person_id ) ) $person_id = get_the_ID();

	// get the person's categories
	$person_categories = get_person_categories( $person_id );

	// if we have categories
	if ( !empty( $person_categories ) ) {

		// loop through the cats
		foreach ( $person_categories as $person_cat ) {

			// return true if their category matches the one we fed in
			if ( $person_cat->slug == $person_category ) return true;

		}
	}

	// if nothing has matched or the categories are empty, return false
	return false;
}


function do_people_tab_nav( $title, $key ) {
	$content = get_cmb_value( "people_" . $key );
	if ( !empty( $content ) ) { 
	?>
		<li class="people-<?php print $key; ?>"><?php print $title ?></li>
	<?php
	} 
}



function do_people_tab_content( $title, $key ) {
	$content = get_cmb_value( "people_" . $key );
	if ( !empty( $content ) ) { 
	?>
			<div class="tab-content People-<?php print $key; ?>">
				<h1><?php print $title ?></h1>
				<?php print wpautop( do_shortcode( $content ) ); ?>
			</div>
	<?php
	} 
}



// People metabox
add_action( 'cmb2_admin_init', 'person_metaboxes' );
function person_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_p_';


    // area of interest information
    $person_box = new_cmb2_box( array(
        'id' => 'person_info',
        'title' => 'Person Details',
        'object_types' => array( 'people' ), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $person_box->add_field( array(
        'name' => 'First Name',
        'id' => $prefix . 'person_fname',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Last Name',
        'id' => $prefix . 'person_lname',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Pronouns',
        'id' => $prefix . 'person_pronouns',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Title',
        'id' => $prefix . 'person_title',
        'type' => 'text'
    ) );
    $person_box->add_field( array(
        'name' => 'Office Number',
        'id' => $prefix . 'person_office',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Phone Number',
        'id' => $prefix . 'person_phone',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Email Address',
        'id' => $prefix . 'person_email',
        'type' => 'text_email'
    ) );
    $person_box->add_field( array(
        'name' => 'Website',
        'id' => $prefix . 'person_website',
        'type' => 'text',
        'desc' => 'Include the Full URL (including "http(s)") to this People members website.'
    ) );
    $person_box->add_field( array(
        'name' => 'CV/Resume',
        'id' => $prefix . 'person_cv',
        'type' => 'file',
        'desc' => 'Upload a CV/Resume file.'
    ) );
    $person_box->add_field( array(
        'name' => 'Courses Taught',
        'id' => $prefix . 'person_courses',
        'type' => 'wysiwyg',
        'options' => array (
            'textarea_rows' => 6
        )
    ) );
    $person_box->add_field( array(
        'name' => 'Areas of Interest',
        'id' => $prefix . 'person_interests',
        'type' => 'wysiwyg',
        'options' => array (
            'textarea_rows' => 6
        )
    ) );
    $person_box->add_field( array(
	    'name' => 'Independent Study Advising',
	    'id' => $prefix . 'person_independent',
	    'type' => 'wysiwyg',
	    'options' => array (
	        'textarea_rows' => 6
	    )
	) );
    $person_box->add_field( array(
	    'name' => 'Publications',
	    'id' => $prefix . 'person_publications',
	    'type' => 'wysiwyg',
	    'options' => array (
	        'textarea_rows' => 6
	    )
	) );
    $person_box->add_field( array(
        'name' => 'Presentations',
        'id' => $prefix . 'person_presentations',
        'type' => 'wysiwyg',
        'options' => array (
            'textarea_rows' => 6
        )
    ) );
    $person_box->add_field( array(
        'name' => 'Professional Experience',
        'id' => $prefix . 'person_experience',
        'type' => 'wysiwyg',
        'options' => array (
            'textarea_rows' => 6
        )
    ) );
    $person_box->add_field( array(
        'name' => 'Professional Affiliations',
        'id' => $prefix . 'person_affiliations',
        'type' => 'wysiwyg',
        'options' => array (
            'textarea_rows' => 6
        )
    ) );
    $person_box->add_field( array(
	    'name' => 'Awards/Honors',
	    'id' => $prefix . 'person_awards',
	    'type' => 'wysiwyg',
	    'options' => array (
	        'textarea_rows' => 6
	    )
	) );
    $person_box->add_field( array(
        'name' => 'Production Credits',
        'id' => $prefix . 'person_production_credits',
        'type' => 'wysiwyg',
        'options' => array (
            'textarea_rows' => 6
        )
    ) );
	$person_box->add_field( array(
        'name' => 'Sort',
        'id' => $prefix . 'person_sort',
        'type' => 'text_small'
    ) );


}



// add a people shortcode
function people_shortcode( $atts ) {

	// set default params and override with those in shortcode
	extract( shortcode_atts( array(
		'category' => '',
		'style' => 'grid',
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => '_p_person_lname',
		'search' => 1
	), $atts ));

	// set some query vars
	$vars = array( 
		"posts_per_page" => -1,
		"post_type" => 'people',
		"orderby" => $orderby,
		"meta_key" => $meta_key,
		"order" => $order,
	);

	// if we have a category
	if ( !empty( $category ) ) {
		$vars["tax_query"] = array(
	        array (
	            'taxonomy' => 'people_cat',
	            'field' => 'slug',
	            'terms' => $category,
	        )
	    );
	}


	// run the query
    $p = new WP_Query( $vars );

    $people_content = '<section class="people">';

	if ( $style !== 'lightbox' && $search ) {
		$people_content .= '<div class="people-search"><input type="text" name="people-search-term" id="s" placeholder="Search Name, Academic Department, or Title"></div>';
	}

	if ( $p->have_posts() ) : 

		$people_content .='<div class="people-listing">';

		// Start the Loop.
		while ( $p->have_posts() ) : $p->the_post();

			if ( $style == 'lightbox' ) {

				$people_content .='<div class="person-entry visible">' . 
					'<a class="person-bio-link" rel="person-' . get_the_ID() . '">' . get_the_post_thumbnail() . '</a>' .
					'<div class="info">
						<h4><a class="person-bio-link" rel="person-' . get_the_ID() . '">' . get_cmb_value( "person_fname" ) . ' ' . get_cmb_value( "person_lname" ) . '</a></h4>
						<p class="person-title">' . get_cmb_value( "person_title" ) . '</p>
					</div>
				</div>
				<div class="hidden" id="person-' . get_the_ID() . '">
					<div class="person-bio-lightbox">
						<div class="bio-left">
							<img src="' . get_the_post_thumbnail_url() . '" class="bio-photo" />
						</div>
						<div class="bio-right">' . 
							'<h3>' . get_cmb_value( "person_fname" ) . ' ' . get_cmb_value( "person_lname" ) . '</h3>' .
							'<p class="bio-person-title"><strong>' . get_cmb_value( 'person_title' ) . '</strong></p>' .
							apply_filters( 'the_content', get_the_excerpt() ) . '</div>
					</div>
				</div>';

			} else {

				$people_content .='<div class="person-entry visible">' . 
					'<a href="' . get_the_permalink() . '">' . get_the_post_thumbnail() . '</a>' .
					'<div class="info">
						<h4><a href="' . get_the_permalink() . '">' . get_cmb_value( "person_fname" ) . ' ' . get_cmb_value( "person_lname" ) . '</a></h4>
						<p class="person-title">' . get_cmb_value( "person_title" ) . '</p>
						<p class="person-email"><a href="mailto:' . get_cmb_value( "person_email" ) . '">' . get_cmb_value( "person_email" ) . '</a></p>
					</div>
				</div>';

			}

		endwhile;

	else :
		
		$people_content .= '<p>No people found in database.</p>';

	endif;

	$people_content .='</div>';

	$people_content .='</section>';

	wp_reset_postdata();

	return $people_content;
}
add_shortcode( 'people', 'people_shortcode' );


