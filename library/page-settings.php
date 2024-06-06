<?php


// the output function to display the header on-page.
function the_page_header( $title_override = '', $background_override = '', $color_override = '' ) {
	global $post;
	
	// get featured image.
	$page_header_background = get_cmb_value( 'page_header_background' );
 	
	// override background if specified
 	if ( !empty( $background_override ) ) $page_header_background = $background_override;

    // get the page header background
    $page_header_title = get_cmb_value( 'page_header_title' );

    // override title if specified
    if ( !empty( $title_override ) ) $page_header_title = $title_override;

    // get the page header background
    $page_header_color = get_cmb_value( 'page_header_color' );

    // override title if specified
    if ( !empty( $color_override ) ) $page_header_color = $color_override;


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

    // empty string to start from
    $crumb_code = '';

    // if the ancestor array isn't empty, compile crumb code
    if ( !empty( $crumbs ) ) {

        // loop through the crumbs
        foreach ( $crumbs as $crumb ) {
            $crumb_code .= "<a href='" . get_permalink( $crumb->ID ) . "'>" . $crumb->post_title . "</a> &raquo; ";
        }
    }


	// if we have both a background and a title, output the thing.
	if ( !empty( $page_header_background ) && !empty( $page_header_title ) ) {
		?>
	<div class="page-header <?php print $page_header_color ?>" style="background-image: url(<?php print $page_header_background ; ?>);">
		<div class="page-header-overlay"></div>
        <div class="wrap">
    		<div class="breadcrumbs">
    			<div class="crumbs">
    				<?php print $crumb_code; ?>
    			</div>
    			<h1 class="page-title"><?php print $page_header_title; ?></h1>
    		</div>
        </div>
	</div>
		<?php
	}
}



// little function to output the sidebar menu selected in the page settings box.
function the_sidebar_menu() {
    ?>
    <div class="sidebar-menu-toggle">Section Menu</div>
    <div class="sidebar-menu">
        <?php wp_nav_menu( array( 'menu' => get_cmb_value( 'page_sidebar_menu' ) ) ); ?>
    </div>
    <?php
}



// output (if present) the action nav buttons in the left column
function the_action_nav() {
    if ( has_cmb_value( 'page_action_menu' ) ) {
        wp_nav_menu( array( 'menu' => get_cmb_value( 'page_action_menu' ), 'menu_class' => 'action-nav' ) );
    }
}



// eventually move this to the new 'research guide' cpt
add_action( 'cmb2_admin_init', 'page_settings_metabox', 1 );
function page_settings_metabox() {

    // accordion metabox
    $page_settings_metabox = new_cmb2_box( array(
        'id' => 'page_header_metabox',
        'title' => 'Page Settings',
        'desc' => 'Select the librarian for this study guide.',
        'object_types' => array( 'page', 'people', 'area', 'org' ), // post type
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

    $page_settings_metabox->add_field( array(
        'name' => 'Action Nav',
        'id'   => CMB_PREFIX . 'page_action_menu',
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
