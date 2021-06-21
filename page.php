<?php

/*
Template Name: Page (1-Column)
*/

get_header();

the_page_header();

the_showcase();

?>

<div class="content-wide" role="main">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			the_content();
			the_accordions();
		endwhile;
	endif;

	?>
</div><!-- #content -->

<?php

get_footer();

?>