<?php
/*
Home/catch-all template
*/

get_header(); 

the_page_header( "Wooster News", get_bloginfo('template_url') . '/img/bg-header-news.webp' );

?>

	<div class="content-wide" role="main">

		<div class="article-cards blog-listing">
		<?php

		while ( have_posts() ) : the_post();
			?>
			<div class="entry">
				<div class="thumbnail">
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
				</div>
				<div class="entry-inner">
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<?php the_excerpt(); ?>
				</div>
			</div>
			<?php
		endwhile;

		?>
		</div>

		<div class="pagination">
			<?php pagination(); ?>
		</div>

	</div><!-- #primary -->


<?php get_footer(); ?>