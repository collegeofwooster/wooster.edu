<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>


	<div class="content-wide" role="main">
		<div class="wrap">
			<?php
			$page = get_posts( 17245 );
			print apply_filters( 'the_content', $page->post_content );
			?>
			<p class="search-form"><?php print get_search_form(); ?></p>
		</div>
	</div>

<?php

get_footer();

?>