<?php



// emergency bar output function
add_action ( 'before_content' , 'the_emergency_bar', 20 );
function the_emergency_bar() {

    // narrow content
    $emergency_text = get_cmb_value( "emergency_text" );
    $emergency_link = get_cmb_value( "emergency_link" );
    $emergency_color = get_cmb_value( "emergency_color" );

    if ( !empty( $emergency_text ) ) {
        ?>
    <div class="emergency-bar-container <?php print $emergency_color; ?> <?php print md5( $emergency_text ); ?>">
        <a class="close">X</a>
        <?php if ( !empty( $emergency_link ) ) { ?><a href="<?php print $emergency_link ?>"><?php } ?>
        <div class="emergency-bar-text">
            <?php print do_shortcode( $emergency_text ) ?>
        </div>
        <?php if ( !empty( $emergency_link ) ) { ?></a><?php } ?>
    </div>
        <?php
    }

}



// add metabox(es)
function emergency_metabox( $meta_boxes ) {

    global $colors;

    // emergency metabox
    $emergency_metabox = new_cmb2_box( array(
        'id' => 'emergency_metabox',
        'title' => 'Emergency Bar',
        'desc' => "An emergency bar on the top to indicate local news or bring people into a specific area of the site when there's something you want them to read.",
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ));

    $emergency_metabox->add_field( array(
        'name' => 'Emergency Text',
        'id'   => CMB_PREFIX . 'emergency_text',
        'type' => 'text',
    ) );

    $emergency_metabox->add_field( array(
        'name' => 'Link',
        'desc' => 'Where should the emergency bar link to.',
        'id'   => CMB_PREFIX . 'emergency_link',
        'type' => 'text',
    ) );

    $emergency_metabox->add_field( array(
        'name' => 'Color',
        'desc' => 'What color should the emergency bar be?',
        'id'   => CMB_PREFIX . 'emergency_color',
        'type' => 'select',
        'options' => $colors
    ) );
}
add_filter( 'cmb2_admin_init', 'emergency_metabox', 99 );



