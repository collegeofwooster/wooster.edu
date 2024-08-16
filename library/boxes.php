<?php


function the_boxes() {
	$boxes = get_cmb_value( 'boxes' );

    // only do the thing if we have to
	if ( !empty( $boxes ) ) {
		?>
		<div class="boxes">
		<?php
		foreach ( $boxes as $box ) {
			if ( !empty( $box['color'] ) && !empty( $box['title'] ) && !empty( $box['content'] ) ) { 
				?>
                <div class="abox <?php print $box['color'] ?> <?php print ( !empty( $box['link'] ) ? 'linked' : '' ); ?>" data-href="<?php print ( !empty( $box['link'] ) ? $box['link'] : '' ); ?>">
                    <h4><?php print $box['title'] ?></h4>
                    <?php print wpautop( $box['content'] ) ?>
                </div>
				<?php
			}
		}
        ?>
        </div>
        <?php
	}
}


function boxes_metabox() {

    // get the colors
    global $colors;

    // phototiles metabox
    $boxes = new_cmb2_box( array(
        'id' => 'boxes_metabox',
        'title' => 'Boxes',
        'desc' => 'Responsive boxes with a color, title, copy, and a link.',
        'object_types' => array( 'page' ), // post type
		'show_on_cb' => 'cmb2_show_on_cb',
        'context' => 'normal',
        'priority' => 'high'
    ) );

    $boxes_group = $boxes->add_field( array(
        'id' => CMB_PREFIX . 'boxes',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Box', 'cmb'),
            'remove_button' => __('Remove Box', 'cmb'),
            'group_title'   => __( 'Box {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $boxes->add_group_field( $boxes_group, array(
        'name' => 'Color',
        'desc' => 'Choose a color for this box.',
        'id'   => 'color',
        'type' => 'select',
        'options' => $colors
    ) );

    $boxes->add_group_field( $boxes_group, array(
        'name' => 'Title',
        'desc' => 'Enter a title for this box.',
        'id'   => 'title',
        'type' => 'text'
    ) );

    $boxes->add_group_field( $boxes_group, array(
        'name' => 'Content',
        'desc' => 'Enter content for this box.',
        'id'   => 'content',
        'type' => 'textarea'
    ) );

    $boxes->add_group_field( $boxes_group, array(
        'name' => 'Link',
        'desc' => 'Enter a URL for where this tile should go.',
        'id'   => 'link',
        'type' => 'text'
    ) );

}
add_filter( 'cmb2_admin_init', 'boxes_metabox', 30 );


