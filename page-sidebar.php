<?php

/*
Template Name: Page (2-Column)
*/

get_header();

the_page_header();

the_showcase();

?>

<div class="two-column">
	<div class="wrap">
		<div class="sidebar">
			<?php the_sidebar_menu(); ?>
		</div>
		<div class="right-column">
		<?php 
		
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				?>
			<?php the_content(); ?>
			<?php the_accordions(); ?>
				<?php
			endwhile;
		endif;

		?>
		</div>
	</div>
</div>

<?php

the_phototiles();

get_footer();

?>