<?php


function do_accordion( $title, $content, $color = 'grey-light', $open = 0 ) {
	?>
	<div class="accordion <?php print ( $open ? 'open' : '' ) ?>">
		<div class="accordion-handle <?php print $color; ?>">
			<?php print $title; ?>
		</div>
		<div class="accordion-content">
			<?php print apply_filters( 'the_content', $content ); ?>
		</div>
	</div>
	<?php
}



// accordion output function
function the_accordions() {

	// get the slides
	$accordions = get_post_meta( get_the_ID(), CMB_PREFIX . "accordions", 1 );

	if ( !empty( $accordions ) ) {
		?>
		<div class="accordions">
			<?php
			foreach ( $accordions as $key => $accordion ) {

                if ( !isset( $accordion['open'] ) ) {
                    $accordion['open'] = 'off';
                }
                
				// only output this accordion if we have a title and content
				if ( !empty( $accordion["title"] ) && !empty( $accordion['content'] ) ) {

					// put this accordion into our accordion function so we aren't duplicating code
					do_accordion( $accordion['title'], $accordion['content'], $accordion['color'], ( $accordion['open'] == 'on' ? 1 : 0 ) );

				}

			}
			?>
		</div>
		<?php
	}
}



// accordion metaboxes
add_action( 'cmb2_admin_init', 'accordion_metaboxes' );
function accordion_metaboxes() {

    global $colors;

    // area of interest information
    $accordion_metabox = new_cmb2_box( array(
        'id' => 'accordions',
        'title' => 'Accordions',
        'object_types' => array( 'page', 'events' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    
    $accordion_metabox_group = $accordion_metabox->add_field( array(
        'id' => CMB_PREFIX . 'accordions',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Accordion', 'cmb'),
            'remove_button' => __('Remove Accordion', 'cmb'),
            'group_title'   => __( 'Accordion {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'options' => $colors
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Open By Default',
        'id'   => 'open',
        'type' => 'checkbox',
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Content',
        'id'   => 'content',
        'type' => 'wysiwyg',
    ) );

}

