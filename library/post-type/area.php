<?php



// let's create the function for the custom type
function area_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'area', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 
			'labels' => array(
				'name' => __( 'Areas of Study', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Area of Study', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Areas', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Area', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Area', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Area', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Area', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Areas', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the areas of study listed on the viewbook.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-welcome-learn-more', /* the icon for the custom post type menu */
			'rewrite'	=> array(
				'slug' => 'area', 
				'with_front' => false 
			), /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' )
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'area' );
	
}


// adding the function to the Wordpress init
add_action( 'init', 'area_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'area_cat', 
	array('area'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Area Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Area Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Area Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All Area Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Area Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Area Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Area Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Area Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Area Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Area Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 
			'slug' => 'area-category'
		)
	)
);



add_action( 'cmb2_admin_init', 'area_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function area_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_p_';

	$args = array(
		'taxonomy' => 'people_cat',
		'orderby' => 'name',
		'order'   => 'ASC'
	);
	$cats = get_categories($args);
	$people_cats[''] = '- none -';
    foreach ( $cats as $cat ) {
        $people_cats[$cat->slug] = $cat->name;
    }

    // area of interest information
    $area_box = new_cmb2_box( array(
        'id' => 'area_info',
        'title' => 'Area Details',
        'object_types' => array( 'area' ), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $area_box->add_field( array(
        'name' => 'People to List',
        'desc' => 'Which category of people to display as the faculty list for the faculty list for this area.',
        'id' => $prefix . 'area_faculty_list',
        'type' => 'select',
        'options' => $people_cats,
    ) );

    $all_tags = get_tags();
    $tag_options = array(
        '' => '-- None --'
    );
    foreach ( $all_tags as $tag ) {
        $tag_options[$tag->slug] = $tag->name;
    }
    $area_box->add_field( array(
        'name' => 'Post Tag',
        'id' => $prefix . 'area_post_tag',
        'type' => 'select',
        'options' => $tag_options,
        'default' => get_cmb_value( 'area_post_tag' ),
        'desc' => 'Select a post tag to be used to bring in articles that are associated with this area of study.'
    ));

    $area_box->add_field( array(
        'name' => 'Overview Video',
        'id' => $prefix . 'area_video',
        'type' => 'text',
    ) );
    $area_box->add_field( array(
        'name' => 'Major',
        'id' => $prefix . 'area_major',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Minor',
        'id' => $prefix . 'area_minor',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Independent Study',
        'id' => $prefix . 'area_independent_study',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Certifications',
        'id' => $prefix . 'area_certifications',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Licensure',
        'id' => $prefix . 'area_licensure',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Alumni',
        'id' => $prefix . 'area_alumni',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Student Organizations',
        'id' => $prefix . 'area_student_organizations',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Prizes & Scholarships',
        'id' => $prefix . 'area_scholarships',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Lectures',
        'id' => $prefix . 'area_lectures',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Seminar Series',
        'id' => $prefix . 'area_seminar_series',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Lab Facilities',
        'id' => $prefix . 'area_lab_facilities',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Clinics',
        'id' => $prefix . 'area_clinics',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Fern Valley Field Station',
        'id' => $prefix . 'area_fern_valley',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Requirements',
        'id' => $prefix . 'area_requirements',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Title II',
        'id' => $prefix . 'area_title_ii',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'State Performance Report',
        'id' => $prefix . 'area_state_performance',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Resources',
        'id' => $prefix . 'area_resources',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Unique Opportunities',
        'id' => $prefix . 'area_unique_opportunities',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Ensembles',
        'id' => $prefix . 'area_ensembles',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Productions/Events',
        'id' => $prefix . 'area_productions',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Student Projects',
        'id' => $prefix . 'area_student_projects',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Faculty Emeriti',
        'id' => $prefix . 'area_faculty_emeriti',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'Annual Report',
        'id' => $prefix . 'area_annual_report',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );
    $area_box->add_field( array(
        'name' => 'CAEP Annual Reporting Measures',
        'id' => $prefix . 'area_caep',
        'type' => 'wysiwyg',
        'options' => array (
        	'textarea_rows' => 6
        )
    ) );

}



function the_area_lists() {

	$interests_col_1 = get_post_meta( get_the_ID(), $prefix . "interests_col_1", 1 );
	$interests_col_2 = get_post_meta( get_the_ID(), $prefix . "interests_col_2", 1 );

	if ( !empty( $interests_col_1 ) || !empty( $interests_col_2 ) ) {
		?>
	<div id="search-box" class="search-box group">
		
		<?php if ( is_page( 'beyond-ripon' ) ) { ?>
		<h2>Where will you go?</h2>
		<?php } else { ?>
		<h2>What are you interested in?</h2>
		<?php get_search_form(); ?>
		<?php } ?>
		
		<?php if ( !empty( $interests_col_1	) ) { ?>
		<div class="column">
			<?php 
			foreach ( $interests_col_1 as $cat ) {
				list_interest_category( $cat );
			}
			?>
		</div>
		<?php } ?>
		
		<?php if ( !empty( $interests_col_2	) ) { ?>
		<div class="column">
			<?php 
			foreach ( $interests_col_2 as $cat ) {
				list_interest_category( $cat );
			}
			?>
		</div>
		<?php } ?>

		<?php wp_reset_postdata(); ?>
		
	</div><!-- #content -->
		<?php
	}

}



function list_area_category() {

	// select the areas of interest in the category
	$areas = get_areas();

	// count em
	$area_count = count( $areas );

	// determine what a quarter of the total records is so we can make columns
	$quarter = ceil( $area_count / 2 );

	// loop through the post results
	$num = 1;
	foreach ( $areas as $area ) {
		$categories = wp_get_object_terms( $area->ID, 'area_cat' );
		if ( !empty( $categories ) ) {
			?><?php
			$cats = array();
			$classes = array();
			foreach ( $categories as $cat ) {
	 			switch ( $cat->slug ) {
	 				case "major":
	 					$cats[] = '<span class="ma">Major</span>';
	 					$classes[] = 'ma';
	 				break;
	 				case "minor":
	 					$cats[] = '<span class="mi">Minor</span>';
	 					$classes[] = 'mi';
	 				break;
	 				case "pre-professional-advising":
	 					$cats[] = '<span class="pa">Pre-Professional Advising</span>';
	 					$classes[] = 'pa';
	 				break;
	 				case "teaching-licensure":
	 					$cats[] = '<span class="tl">Teaching Licensure</span>';
	 					$classes[] = 'tl';
	 				break;
	 				case "pathway":
						$cats[] = '<span class="path">Pathway</span>';
						$classes[] = 'path';
					break;
					case "dual":
						$cats[] = '<span class="dual">Dual Degree Program</span>';
						$classes[] = 'dual';
					break;
			   }
			}
		}
		?>
		<div class="area <?php print implode( ' ', $classes ); ?>">
			<a href="/area/<?php print $area->post_name ?>"><h3><?php print $area->post_title; ?></h3></a>
			<p><?php print $area->post_excerpt; ?></p>
			<?php print implode( ' ', $cats ); ?>
		</div>
		<?php
	}
	?>
	<?php
	
	// reset the post data
	wp_reset_postdata();

}



function get_area_cats( $area_id ) {
	$categories = wp_get_object_terms( $area_id, 'area_cat' );
	if ( !empty( $categories ) ) {
		?><?php
		$cats = array();
		$classes = array();
		foreach ( $categories as $cat ) {
 			switch ( $cat->slug ) {
 				case "major":
 					$cats[] = '<span class="ma">Major</span>';
 				break;
 				case "minor":
 					$cats[] = '<span class="mi">Minor</span>';
 				break;
 				case "pre-professional-advising":
 					$cats[] = '<span class="pa">Pre-Professional Advising</span>';
 				break;
 				case "teaching-licensure":
 					$cats[] = '<span class="tl">Teaching Licensure</span>';
 				break;
 				case "pathway":
					$cats[] = '<span class="path">Pathway</span>';
				break;
				case "dual":
					$cats[] = '<span class="dual">Dual Degree Program</span>';
				break;
		   }
		}
	}
	return $cats;
}



function get_areas() {
	global $wpdb;

	// Count custom post type by custom taxonomy
	$sql = "SELECT * FROM $wpdb->posts p
	WHERE p.post_type = 'area'
	AND ( p.post_status = 'publish' )
	AND p.post_date < NOW() ORDER BY p.post_title;";

	$rows = $wpdb->get_results( $sql );

	return $rows;
}



function get_area_category( $category ) {
	global $wpdb;

	// Count custom post type by custom taxonomy
	$sql = "SELECT * FROM $wpdb->posts p
	JOIN $wpdb->term_relationships tr ON (p.ID = tr.object_id)
	JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'area_cat')
	JOIN $wpdb->terms t ON (tt.term_id = t.term_id AND t.slug = '$category' )
	WHERE p.post_type = 'area'
	AND (p.post_status = 'publish')
	AND p.post_date < NOW() ORDER BY p.post_title;";

	$rows = $wpdb->get_results( $sql );

	return $rows;
}



function do_area_tab_nav( $title, $key ) {
	$content = get_cmb_value( "area_" . $key );
	if ( !empty( $content ) ) { 
	?>
			<li class="area-<?php print $key; ?>"><?php print $title ?></li>
	<?php
	} 
}



function do_area_tab_content( $title, $key ) {
	$content = get_cmb_value( "area_" . $key );
	if ( !empty( $content ) ) {
		global $post;
		$area_slug = $post->post_name;
	?>
			<div class="tab-content area-<?php print $key; ?>">
				<h2><?php print $title ?></h2>
				<?php print apply_filters( 'the_content', $content ); ?>

				<?php 
				if ( $key == 'independent_study' ) {
					?>
				<hr>
				<h3>Related Articles</h3>
					<?php
					print do_shortcode( '[articles cat="independent-study" tag="' . $area_slug . '" /]' );
				} ?>

				<?php 
				if ( $key == 'alumni' ) {
					?>
				<hr>
				<h3>Related Articles</h3>
					<?php
					print do_shortcode( '[articles cat="alumni-profile" tag="' . $area_slug . '" /]' );
				} ?>
			</div>
	<?php
	} 
}


