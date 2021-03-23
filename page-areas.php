<?php

/*
Template Name: Areas of Study
*/

get_header();

?>
	
	<?php the_page_header(); ?>
	
	<div class="one-column areas">
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php endwhile; ?>
		<div class="wrap group two-column academics">
		
			<div class="area-filter">
				<select><option value="all">-- All Areas --</option><option value="ma">Major</option><option value="mi">Minor</option><option value="ppa">Pre-Professional Advising</option><option value="tl">Teaching Licensure</option><option value="path">Pathway</option></select>
			</div>
			<hr />
			<div class="group area-listing">
				<?php list_area_category() ?>
			</div>

		</div>
	</div>

<?php get_footer(); ?>