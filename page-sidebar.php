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
			<?php 
			the_sidebar_menu();
			the_action_nav(); 
			?>
		</div>
		<div class="right-column">
		<?php 
		
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				the_post_showcase();
				the_content(); 
				the_boxes();
				the_accordions();
			endwhile;
		endif;

		?>
		</div>
	</div>
</div>

<?php

the_statistics();

the_phototiles();

get_footer();

?>