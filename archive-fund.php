<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 
	
the_page_header( 'Crowdfunding Campaigns', get_bloginfo('template_url') . '/img/bg-page-header-fund.webp' );

?>

	<div class="one-column">

		<div class="wrap">

		<?php 

		global $wp_query;
		$wp_query->query_vars["orderby"] = 'title';
		$wp_query->query_vars["order"] = 'ASC';
		$wp_query->get_posts();

		if ( have_posts() ) : 
			?>

			<div class="fund-listing">
			<?php

			// Start the Loop.
			while ( have_posts() ) : the_post(); 
				?>
				<div class="fund">
					
					<div class="photo">
						<a href="<?php the_permalink() ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'post-thumbnail' );
						} else {
							print '<img src="https://placehold.it/500x500">';
						}

						/*
						$fund_info = get_fund_info();
						if ( $fund_info['total'] > 0 ) {
							print '<h4 class="fund-total">' . $fund_info['percent'] . '% Funded <span>(' . $fund_info['count'] . ' Donors)</span></h4>';
						}
						*/
						?>
						</a>
					</div>
					<div class="info">
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<?php the_excerpt(); ?>
					</div>

				</div>
				<?php

			endwhile;
			
			?>
			</div>
			<?php

		else : 

			print '<p>No results for that search term.</p>';

		endif;

		?>

		</div>

	</div>

<?php

get_footer();

?>