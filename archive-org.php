<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

the_page_header( 'Student Organizations', get_bloginfo('template_url') . '/img/bg-header-news.webp' );

?>

	<div class="content-wide" role="main">

		<div class="orgs-listing">
		 	<h3>A</h3>
			<ul class="org-listing-section">
		<?php

		while ( have_posts() ) : the_post();
			?>
				<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			<?php
		endwhile;

		?>
			</ul>
		</div>

	</div><!-- #primary -->

<?php

get_footer();

?>