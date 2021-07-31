<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js?v=6', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );



// register a couple nav menus
register_nav_menus( array(
	'main-menu' => 'Main Menu',
    'main-menu-helpful' => 'Main Menu - Helpful Links',
    'main-menu-locations' => 'Main Menu - Locations',
    'main-menu-info-for' => 'Main Menu - Info For',
    'header-buttons' => 'Header Buttons',
    'footer-links' => 'Footer Links',
    'sidebar-orgs' => 'Sidebar - Student Organizations',
    'library-guides' => 'Library - Research Guides',
    'library-databases' => 'Library - Databases',
    'area-action-nav' => 'Areas of Study - Action Nav',
    'jobs-sidebar' => 'Jobs Menu',
    'student-organizations' => 'Student Orgs Navigation'
) );



// register a generic sidebar.
register_sidebar( array(
	'id' => 'sidebar-generic',
	'name'=> 'General Sidebar',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h4>',
    'after_title' => '</h4></div>',
) );



// enable webp uploads in the media library
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');



// pagination
function pagination( $prev = '&laquo;', $next = '&raquo;' ) {
    
    global $wp_query, $wp_rewrite, $paged;

    $posts_per_page = ( isset( $wp_query->query_vars['posts_per_page'] ) ? $wp_query->query_vars['posts_per_page'] : 16 );

    $total = ceil( $wp_query->found_posts / $posts_per_page );

    $current = ( !empty( $paged ) ? $paged : 1 );

    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $total,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
    );

    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    echo paginate_links( $pagination );

}



// small boolean function to check if we're in cli or fpm
function is_cli() {
    if ( php_sapi_name() == "cli" ) return true;
    return false;
}



// a simple function to output a nav menu as a select list
function quick_nav_menu( $theme_location, $first_item ) {

    // get all locations
    $locations = get_nav_menu_locations();
 
    // get object id by location
    $object = wp_get_nav_menu_object( $locations[$theme_location] );
 
    // get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name );
 
    // if we have items, loop through them
    if ( !empty( $menu_items ) ) {  
        print "<select class='quick-nav'>";
        if ( !empty( $first_item ) ) print "<option value='none'>" . $first_item . "</option>";
        foreach ( $menu_items as $item ) {
            print "<option value='" . $item->url . "'>" . $item->title . "</option>";
        }
        print "</select>";
    }
}



// the_content filter to remove test/staging URLs before outputting content
add_action( 'the_content', 'strip_test_domains' );
function strip_test_domains( $content ) {
    $content = str_replace( 'https://wooster.jpederson.com', '', $content );
    $content = str_replace( 'http://test.wooster.test', '', $content );
    return $content;
}



