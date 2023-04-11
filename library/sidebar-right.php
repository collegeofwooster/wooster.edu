<?php



// sidebar-right output function
function the_sidebar_right() {

    // narrow content
    $sidebar_right = get_cmb_value( "sidebar-right" );

    if ( !empty( $sidebar_right ) ) {
        print apply_filters( 'the_content', $sidebar_right );
    }

}



// add metabox(es)
function sidebar_right_metabox( $meta_boxes ) {

    global $colors;

    // emergency metabox
    $sidebar_right_metabox = new_cmb2_box( array(
        'id' => 'sidebar_right_metabox',
        'title' => 'Right Sidebar Content',
        'desc' => "A simple wysiwyg to manage the right sidebar content",
        'object_types' => array( 'page' ), // post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'page-3col.php' ),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $sidebar_right_metabox->add_field( array(
        'name' => 'Sidebar Content',
        'id'   => CMB_PREFIX . 'sidebar-right',
        'type' => 'wysiwyg',
    ) );
}
add_filter( 'cmb2_admin_init', 'sidebar_right_metabox' );



