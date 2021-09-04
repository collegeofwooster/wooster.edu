<?php

/*
Template Name: Page (3-column)
*/

get_header();

the_page_header();

the_showcase();

?>

<div class="three-column" role="main">
	<div class="wrap">
		<div class="sidebar">
			<?php 
			the_sidebar_menu();
			the_action_nav(); 
			?>
		</div>
		<div class="middle-column">
		<?php 
		
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				the_content();
				the_boxes();
				the_accordions();
			endwhile;
		endif;

		?>
		</div>
		<div class="aside">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?>no sidebar selected<?php endif; ?>
		</div>
	</div>
</div><!-- #content -->

<?php

the_statistics();

the_phototiles();

get_footer();

?>