<?php

/*
Template Name: Page (3-column)
*/

get_header();

the_page_header();

the_showcase();

?>

<div class="content-wide" role="main">
	<div class="quarter sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?>no sidebar selected<?php endif; ?>
	</div>
	<div class="half">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	endif;

	?>
	</div>
	<div class="quarter sidebar-right">
		<?php the_sidebar_right(); ?>
	</div>
</div><!-- #content -->

<?php

the_phototiles();

get_footer();

?>