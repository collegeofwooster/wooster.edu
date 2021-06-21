<?php

/*
Template Name: Page w/ Sidebar
*/

get_header();

the_page_header();

the_showcase();

?>

<div class="two-column">
	<div class="sidebar">
		<?php the_sidebar_menu(); ?>
	</div>
	<div class="right-column">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>
		<h1 class="post-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
			<?php
		endwhile;
	endif;

	?>
	</div>
</div>

<?php

get_footer();

?>