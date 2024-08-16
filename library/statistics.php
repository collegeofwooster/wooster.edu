<?php


function the_statistics() {
	$statistics_background = get_cmb_value( 'statistics-background' );
	$statistics = get_cmb_value( 'statistics' );

	if ( !empty( $statistics ) ) {
		?>
	<div class="front-statistics"<?php print ( !empty( $statistics_background ) ? ' style="' . $statistics_background . '"' : '' ); ?>>
		<div class="front-statistics-inner">

			<?php
			foreach ( $statistics as $stat ) {
				if ( !empty( $stat['icon'] ) && !empty( $stat['number'] ) && !empty( $stat['label'] ) ) {
					?>
			<div class="stat">
				<img src="<?php print $stat['icon']; ?>" alt="<?php print $stat['label']; ?>" />
				<h4><?php print $stat['number']; ?></h4>
				<p><?php print $stat['label']; ?></p>
			</div>
					<?php 
				}
			}
			?>

		</div>
	</div>
		<?php
	}
}



// statistics metaboxes
add_action( 'cmb2_admin_init', 'statistics_metaboxes' );
function statistics_metaboxes() {

    global $colors;

    // area of interest information
    $statistics_metabox = new_cmb2_box( array(
        'id' => 'statistics',
        'title' => 'Statistics',
        'object_types' => array( 'page' ), // Post type
		'show_on_cb' => 'cmb2_show_on_cb',
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $statistics_metabox->add_field( array(
        'name' => 'Statistics Background',
        'id'   => CMB_PREFIX . 'statistics-background',
        'type' => 'file',
        'preview_size' => array( 600, 250 )
    ) );
    
    $statistics_metabox_group = $statistics_metabox->add_field( array(
        'id' => CMB_PREFIX . 'statistics',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Stat', 'cmb'),
            'remove_button' => __('Remove Stat', 'cmb'),
            'group_title'   => __( 'Stat {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $statistics_metabox->add_group_field( $statistics_metabox_group, array(
        'name' => 'Icon',
        'id'   => 'icon',
        'type' => 'file',
        'preview_size' => array( 100, 100 )
    ) );

    $statistics_metabox->add_group_field( $statistics_metabox_group, array(
        'name' => 'Number',
        'id'   => 'number',
        'type' => 'text',
    ) );

    $statistics_metabox->add_group_field( $statistics_metabox_group, array(
        'name' => 'Label',
        'id'   => 'label',
        'type' => 'text',
    ) );

}


