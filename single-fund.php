<?php
/**
 * The Template for displaying all single posts
 */

get_header();

the_showcase();

?>
	<div id="primary" class="wrap group">
		<div id="content" class="content-narrow" role="main">
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				?>
				<h1><?php the_title(); ?></h1>
				<?php

				$fund_info = get_fund_info();
				if ( $fund_info['total'] > 0 ) {
					print '<h4 class="fund-total"><span>Goal Progress:</span> $' . $fund_info['total_formatted'] . " / $" .  $fund_info['goal_formatted'] . ' (' . $fund_info['percent'] . '%)</h4>';
				}

				the_content();

				// grab the form ID and get info and display if a form has been set.
				if ( $fund_info['fund_form'] != 0 ) {
					// display the actual form
					print do_shortcode("[gravityform id=" . $fund_info['fund_form'] . " title=false description=false]");
				} else {
					print "<p class='no-form quiet'>No form has been selected for this crowdfunding campaign, please click 'Edit' in the top bar and select the form that should show up in this section.</p>";
				}

			endwhile;
		endif;
		 ?>
		</div><!-- #content -->

	</div><!-- #primary -->
<?php

get_footer();

?>