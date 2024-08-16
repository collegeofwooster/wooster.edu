<?php


function get_components() {

// if we have components for this page
if( have_rows('components') ):
    
    // loop through the components
    while ( have_rows('components') ) : the_row();

        // include the specific layout
        get_template_part( 'library/component/' . get_row_layout() );

    endwhile;

endif;

}



// boolean function to check if we have any components (they'll replace the rest of the components)
function have_components() {
    if ( have_rows('components') ) :
        return true;
    endif;
    return false;
}



// Dynamically populate select field with menu items when it has the name 'nav-menu'
// @link https://www.advancedcustomfields.com/resources/acf-load_field/
// @link https://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
add_filter( 'acf/load_field/name=nav-menu', 'nav_menus_load' );
function nav_menus_load( $field ) {
    $menus = wp_get_nav_menus();
    $field['choices'][0] = '- no menu -';
    if ( ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            $field['choices'][ $menu->slug ] = $menu->name;
        }
    }
    return $field;
}


// add a wysiwyg 'short' class
add_action('admin_head', 'acf_wysiwyg_short');
function acf_wysiwyg_short() {
	?>
	<style>
    .short .acf-editor-wrap iframe {			
        height: 170px !important;
    }
    .medium .acf-editor-wrap iframe {			
        height: 250px !important;
    }
    .short .mce-statusbar, .medium .mce-statusbar {
        display: none;
    }
	</style>
	<?php
}

