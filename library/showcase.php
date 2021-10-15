<?php


// function to use on front-end templates to output the showcase.
function the_showcase() {

	// get the slides
	$slides = get_post_meta( get_the_ID(), "showcase", 1 );

	if ( !empty( $slides ) ) {
		?>
		<div class="showcase<?php print ( !is_front_page() ? ' interior' : '' ) ?>">
		<?php
		$count = 0;
		foreach ( $slides as $key => $slide ) {
			if ( !empty( $slide["image"] ) ) {

				// store the content, link, image, and title (if applicable)
				$content = ( isset( $slide["content"] ) ? $slide["content"] : '' );
				$link = strip_test_domains( ( isset( $slide["link"] ) ? $slide["link"] : '' ) );
				$image = strip_test_domains( $slide['image'] );
				$video = strip_test_domains( $slide['video'] );
				$title = ( isset( $slide['title'] ) ? $slide['title'] : '' );

				?>
			<div class="slide<?php print ( $key==0 ? ' visible' : '' ); ?>" style="background-image: url(<?php print $image; ?>);<?php print ( !empty( $link ) ? 'cursor: pointer;' : '' ) ?>"<?php print ( !empty( $link ) ? ' data-href="' . $link . '"' : '' ) ?>>
				
				<?php if ( stristr( $video, '.webm' ) ) { ?>
				<video class="slide-video" autoplay muted loop>
					<source src="<?php print $video; ?>" type="video/webm">
				</video>
				<?php } ?>
				<?php if ( !empty( $content ) ) { ?>
				<div class="showcase-overlay"></div>
				<div class="slide-content">
					<div class="wrap">
					<?php 
					if ( !empty( $content ) ) {
						print apply_filters( 'the_content', $content );
					}
					?>
					</div>
				</div>
				<?php } else if ( !empty( $title ) ) { ?>
					<h1 class="slide-title"><?php print $title; ?></h1>
				<?php } ?>

			</div>
				<?php

				$count++;
			}
		}
		?>
		<?php
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



// simple boolean function to check if a url is for a video
function is_video_link( $link ) {
	if ( !empty( $link ) ) {
		if ( stristr( $link, 'youtube.com' ) || stristr( $link, 'youtu.be' ) || stristr( $link, 'vimeo.com' ) ) {
			return true;
		}
	}
	return false;
}



// add the showcase metabox
function showcase_metabox( $meta_boxes ) {

    $showcase_metabox = new_cmb2_box( array(
        'id' => 'showcase_metabox',
        'title' => 'Showcase',
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $showcase_metabox_group = $showcase_metabox->add_field( array(
        'id' => 'showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Slide', 'cmb2'),
            'remove_button' => __('Remove Slide', 'cmb2'),
            'group_title'   => __( 'Slide {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Image',
        'id'   => 'image',
        'desc'   => 'Upload a preview image to load into the video tag (or display on mobile instead of the video).',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Video',
        'id'   => 'video',
        'desc' => 'Upload a .webm video file to use on large screens.',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Content',
        'desc' => 'Enter the content for the slide.',
        'id'   => 'content',
        'type' => 'wysiwyg',
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Title',
        'desc' => "Enter the title for this page - this will only be visible if you don't enter any content.",
        'id'   => 'title',
        'type' => 'text',
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Link',
        'id'   => 'link',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_admin_init', 'showcase_metabox', 5 );


