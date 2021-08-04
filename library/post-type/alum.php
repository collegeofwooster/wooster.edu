<?php



// let's create the function for the custom type
function alum_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'alum', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Alumni', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Alumnus', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Alumni', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Alumnus', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Alumnus', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Alumnus', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Alumnus', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Alumni', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage alumni.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-welcome-learn-more', /* the icon for the custom post type menu */
			'has_archive' => 'classnotes', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */	
}


// adding the function to the Wordpress init
add_action( 'init', 'alum_post_type');


global $states;
$states = array(
    '0' =>'State',
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'FM'=>'Federated States of Micronesia',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
    'AE'=>'Armed Forces Africa \ Canada \ Europe \ Middle East',
    'AA'=>'Armed Forces America (Except Canada)',
    'AP'=>'Armed Forces Pacific',
    'UK'=>'United Kingdom'
);


// set up an array of years from 1940 to current
global $years;
$years = array();
$years[0] = '- none -';
$n = 1942;
while ( $n < ( date( 'Y' ) + 1 ) ) {
    $years[$n] = $n;
    $n++;
}


// let's set up the alum categories array so we don't have to 
// define them in multiple places.
global $alum_categories;
$alum_categories = array(
    'achievements' => 'Professional Achievements',
    'births-and-family' => 'Births and Family',
    'in-memoriam' => 'In Memoriam',
    'weddings-marriages' => 'Weddings and Marriages',
    'encounters' => 'Wooster Encounters',
    'moving' => 'Moving/Relocation',
    'personal' => 'Personal Updates'
);


// the alumni metaboxes
add_action( 'cmb2_admin_init', 'alum_metaboxes' );
function alum_metaboxes() {

    global $states, $years, $alum_categories;

    // area of interest information
    $alum_box = new_cmb2_box( array(
        'id' => 'alum_info',
        'title' => 'Alumnus Details',
        'object_types' => array( 'alum' ), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $alum_box->add_field( array(
        'name' => 'First Name',
        'id'   => CMB_PREFIX . 'alum_name_first',
        'type' => 'text',
    ) );
    $alum_box->add_field( array(
        'name' => 'Last Name',
        'id'   => CMB_PREFIX . 'alum_name_last',
        'type' => 'text',
    ) );
    $alum_box->add_field( array(
        'name' => 'Maiden Name',
        'id'   => CMB_PREFIX . 'alum_name_maiden',
        'type' => 'text',
    ) );
    $alum_box->add_field( array(
        'name' => 'City',
        'id'   => CMB_PREFIX . 'alum_city',
        'type' => 'text',
    ) );
    $alum_box->add_field( array(
        'name' => 'State',
        'id'   => CMB_PREFIX . 'alum_state',
        'type' => 'select',
        'options' => $states,
        'default' => 0
    ) );
    $alum_box->add_field( array(
        'name' => 'Email',
        'id'   => CMB_PREFIX . 'alum_email',
        'type' => 'text_email',
    ) );
    $alum_box->add_field( array(
        'name' => 'Type of Update',
        'id'   => CMB_PREFIX . 'alum_category',
        'type' => 'select',
        'options' => $alum_categories,
        'default' => 'personal'
    ) );
    $alum_box->add_field( array(
        'name' => 'Class Year',
        'id'   => CMB_PREFIX . 'alum_year',
        'type' => 'select',
        'options' => $years,
        'default' => date( 'Y' )
    ) );
    $alum_box->add_field( array(
        'name' => 'Submitted By',
        'id'   => CMB_PREFIX . 'alum_submitter',
        'type' => 'text',
    ) );

}


// a little function to get show the category images for the alumni posts
function show_alum_category_image( $category ) {
    print '<img src="' . get_bloginfo( 'template_url' ) . '/img/alum-' . $category . '.webp">';
}


// function to get the alumni category name
function get_alum_category_name( $category ) {
    // grab the alum_categories global and return the name based on given key
    global $alum_categories;
    return $alum_categories[$category];
}

