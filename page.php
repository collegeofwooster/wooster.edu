<?php

/*
Template Name: Page (1-Column)
*/

get_header();

the_page_header();

the_showcase();

?>

<div class="content-wide" role="main">
	<div class="wrap">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			the_post_showcase();
			the_content();
					
			print "<hr />";
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
			the_boxes();
			the_accordions();
		endwhile;
	endif;

	?>
	</div>
</div><!-- #content -->

<?php

the_statistics();

the_phototiles();

get_footer();

?>