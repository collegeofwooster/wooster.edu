<?php


function the_phototiles() {
	$tiles = get_cmb_value( 'phototile' );

    // only do the thing if we have to
	if ( !empty( $tiles ) ) {
		?>
		<div class="phototiles">
		<?php
		foreach ( $tiles as $tile ) {
			if ( !empty( $tile['background'] ) ) { 
				?>
                <div class="phototile" style="background-image: url(<?php print $tile['background'] ?>);" data-href=""><?php if ( !empty( $tile['link'] ) ) { ?><a href="<?php print $tile['link'] ?>" class="<?php print ( link_is_image( $tile['link'] ) ? 'lightbox' : ( link_is_video( $tile['link'] ) ? 'lightbox-iframe' : '' ) ); ?>"></a><?php } ?></div>
				<?php
			}
		}
        ?>
        </div>
        <?php
	}
}


function link_is_image( $link ) {
    if ( stristr( $link, '.jpg' ) || stristr( $link, '.jpeg' ) || stristr( $link, '.gif' ) || stristr( $link, '.webp' ) ) {
        return true;
    }
    return false;
}


function link_is_video( $link ) {
    if ( stristr( $link, 'youtube' ) || stristr( $link, 'vimeo' ) ) {
        return true;
    }
    return false;
}


function phototiles_metabox() {

    // phototiles metabox
    $phototiles = new_cmb2_box( array(
        'id' => 'phototiles_metabox',
        'title' => 'Photo Tiles',
        'desc' => 'A 4-column component with background images for each of 4 columns, colors, and text displaying for each.',
        'object_types' => array( 'page', 'org' ), // post type
        'context' => 'normal',
        'priority' => 'high'
    ) );

    $phototiles_group = $phototiles->add_field( array(
        'id' => CMB_PREFIX . 'phototile',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Tile', 'cmb'),
            'remove_button' => __('Remove Tile', 'cmb'),
            'group_title'   => __( 'Tile {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $phototiles->add_group_field( $phototiles_group, array(
        'name' => 'Background',
        'desc' => 'Select a photo for the background of this tile.',
        'id'   => 'background',
        'type' => 'file',
        'preview_size' => array( 350, 150 )
    ) );

    $phototiles->add_group_field( $phototiles_group, array(
        'name' => 'Link',
        'desc' => 'Enter a URL for where this tile should go.',
        'id'   => 'link',
        'type' => 'text'
    ) );

}
add_filter( 'cmb2_admin_init', 'phototiles_metabox', 30 );


