<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>


	<div class="content-wide" role="main">
		<div class="wrap">
			<?php

			// select the page they wanted for the 404
			$page = get_post( 17245 );

			// output the content
			print apply_filters( 'the_content', $page->post_content );
			
			?>
			<p class="search-form"><?php print get_search_form(); ?></p>
		</div>
	</div>

<?php

get_footer();

?>