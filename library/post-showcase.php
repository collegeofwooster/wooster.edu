<?php


// function to use on front-end templates to output the showcase.
function the_post_showcase() {

	// get the slides
	$slides = get_post_meta( get_the_ID(), "post-showcase", 1 );

	// if we have photo slides for the current post.
	if ( !empty( $slides ) ) {
		?>
		<div class="post-showcase">
		<?php

		// set an empty count
		$count = 0;

		// loop through the slides
		foreach ( $slides as $key => $slide ) {

			// if we've got an image for this slide
			if ( !empty( $slide["image"] ) ) {

				// store the image and title (if applicable)
				$image = strip_test_domains( $slide['image'] );
				$title = ( isset( $slide['title'] ) ? $slide['title'] : '' );

				// output the slide
				?>
			<div class="slide<?php print ( $key==0 ? ' visible' : '' ); ?>">
				<img src="<?php print $image; ?>" alt="<?php print $title; ?>" />
				<p class="slide-caption"><?php print $title; ?></p>
			</div>
				<?php

				// increment the slide count
				$count++;
			}
		}
		?>
		<?php

		// if we have more than one slide, output the nav so people can switch slides.
		if ( $count > 1 ) { 
			?>
			<div class="showcase-nav">
				<a class="previous">Previous</a>
				<a class="next">Next</a>
			</div>
			<?php
		}
		?>
		</div>
		<?php
	}

}


// add the showcase metabox
function post_showcase_metabox( $meta_boxes ) {

    $post_showcase_metabox = new_cmb2_box( array(
        'id' => 'post_showcase_metabox',
        'title' => 'Post Showcase',
        'object_types' => array( 'page', 'post' ), // post type
		'show_on_cb' => 'cmb2_show_on_cb',
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $post_showcase_metabox_group = $post_showcase_metabox->add_field( array(
        'id' => 'post-showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Slide', 'cmb2'),
            'remove_button' => __('Remove Slide', 'cmb2'),
            'group_title'   => __( 'Slide {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $post_showcase_metabox->add_group_field( $post_showcase_metabox_group, array(
        'name' => 'Image',
        'desc' => 'Upload a photo for this post/page slide.',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $post_showcase_metabox->add_group_field( $post_showcase_metabox_group, array(
        'name' => 'Title',
        'desc' => "Enter caption text for this photo (will also be used as the alt text.",
        'id'   => 'title',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_admin_init', 'post_showcase_metabox', 5 );


