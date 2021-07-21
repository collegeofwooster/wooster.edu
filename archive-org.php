<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

the_page_header( 'Student Organizations', get_bloginfo('template_url') . '/img/bg-header-news.webp' );


$org_cats = get_org_categories();
?>

	<div class="content-wide" role="main">
		<div class="wrap">

			<div class="org-listing">
				<?php 
				foreach ( $org_cats as $org_cat ) {
					?>
				<div class="org-category">
				 	<h4><?php print $org_cat->name; ?></h4>
					<ul class="org-list">
					<?php
					query_posts( 'post_type=org&org_cat=' . $org_cat->slug );
					while ( have_posts() ) : the_post();
						print '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					endwhile;
					?>
					</ul>
				</div>
					<?php 
				} 
				?>
			</div>

		</div>
	</div><!-- #primary -->

<?php

get_footer();

?>