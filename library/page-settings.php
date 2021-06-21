<?php


// the output function to display the header on-page.
function the_page_header( $title_override = '', $background_override = '' ) {
	global $post;
	
	// get featured image.
	$featured_image_url = ( has_cmb_value( 'page_header_background' ) ? get_cmb_value( 'page_header_background' ) : get_the_post_thumbnail_url( null, 'full' ) );
 	
	if ( !empty( $background_override ) ) {
		$featured_image_url = $background_override;
	}

	// get page ancestors
	$ancestors = get_post_ancestors( get_the_ID() );

	// get ancestor info
	$crumbs = array();
	if ( !empty( $ancestors ) ) {
		foreach ( $ancestors as $anc ) {
			$crumbs[] = get_page( $anc );
		}
	}

	// reverse the order of the ancestors in the crumbs
	$crumbs = array_reverse( $crumbs );


	// if the ancestor array isn't empty, compile crumb code
	if ( !empty( $crumbs ) ) {

		// empty string to start from
		$crumb_code = '';

		// loop through the crumbs
		foreach ( $crumbs as $crumb ) {
			$crumb_code .= "<a href='" . get_permalink( $crumb->ID ) . "'>" . $crumb->post_title . "</a> &raquo; ";
		}
	}
	?>
	<div class="page-header"<?php print ( !empty( $featured_image_url ) ? ' style="background-image: url(' . $featured_image_url . ')"' : '' ); ?>>
		<div class="page-header-overlay"></div>
		<div class="breadcrumbs">
			<div class="crumbs">
				<?php print_r( $crumb_code ); ?>
				<!--<a href="/academics">Academics</a> &raquo; <a href="/areas-of-study">Areas of Study</a> &raquo; -->
			</div>
			<h1 class="page-title"><?php print ( !empty( $title_override ) ? $title_override : get_the_title() ); ?></h1>
		</div>
	</div>
	<?php
}



// little function to output the sidebar menu selected in the page settings box.
function the_sidebar_menu() {
	wp_nav_menu( array( 'menu' => get_cmb_value( 'page_sidebar_menu' ) ) );
}



// eventually move this to the new 'research guide' cpt
add_action( 'cmb2_admin_init', 'page_settings_metabox', 1 );
function page_settings_metabox() {

    // accordion metabox
    $page_settings_metabox = new_cmb2_box( array(
        'id' => 'page_header_metabox',
        'title' => 'Page Settings',
        'desc' => 'Select the librarian for this study guide.',
        'object_types' => array( 'page', 'people', 'area' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );
    $page_settings_metabox->add_field( array(
        'name' => 'Title',
        'id'   => CMB_PREFIX . 'page_header_title',
        'desc' => 'Enter a title that overrides the page title above if set.',
        'type' => 'text'
    ) );
    $page_settings_metabox->add_field( array(
        'name' => 'Background',
        'id' => CMB_PREFIX . 'page_header_background',
        'type' => 'file',
        'desc' => 'Upload a background photo that will override the default image used for the section in which this page/content is.'
    ) );

    $page_settings_metabox->add_field( array(
        'name' => 'Menu',
        'id'   => CMB_PREFIX . 'page_sidebar_menu',
        'type' => 'select',
        'options' => get_all_menus()
    ) );

}



// get all wp menus in an array.
function get_all_menus(){
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 

    $generated = array( '' => '- select a menu -' );
    foreach ( $menus as $menu ) {
        $generated[$menu->slug] = $menu->name;
    }

    return $generated;
}
