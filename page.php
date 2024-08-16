<?php

/*
Template Name: Page (1-Column)
*/

get_header();

the_page_header();

if ( has_showcase() ) { ?>
	<div class="showcase-container">
		<?php the_showcase(); ?>
	</div>
	<a name="content-start"></a>
	<?php 
}

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 
		global $post;
		if ( $post->post_content !== '' ):
?>
<div class="content-wide" role="main">
	<div class="wrap">
	<?php 
		the_post_showcase();
		the_content();
		
		the_boxes();
		the_accordions();
	?>
	</div>
</div><!-- #content -->
<?php
		endif;
	endwhile;
endif;

get_components();

the_statistics();

the_phototiles();

get_footer();

