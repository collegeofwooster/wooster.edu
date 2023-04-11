<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

global $wp_query;


// start building args for query_posts
$args = array_merge( $wp_query->query_vars, array(
	'post_type' => 'job',
	'orderby' => 'title',
	'order' => 'ASC',
	'posts_per_page' => 1000
) );


// if we have a type query
if ( !empty( $type_query ) ) {
	// add it in addition to the expiration query
	$args['meta_query'] = array(
		'relation' => 'AND',
		$expires_query
	);
} else {
	// othewise just use the expiration query.
	$args['meta_query'] = $expires_query;
}


query_posts( $args );

$job_count = $wp_query->found_posts;


// output a header
the_page_header( 'Wooster Careers', get_bloginfo('template_url') . "/img/bg-header-jobs.webp" );

?>
	
	<div class="two-column" role="main">
		<div class="wrap">

			<div class="sidebar">
				<?php wp_nav_menu( array( 'theme_location' => 'jobs-sidebar', 'menu_class' => 'menu' ) ); ?>
			</div>

			<div class="right-column">
				<div class="job-filter">
					<div class="job-search"><label for="job-search">Search:</label> <input type="text" id="job-search" value="" placeholder="Search Jobs"></div>
					<div class="job-count"><strong>Showing <?php print $job_count; ?> Job<?php print ( $job_count == 1 ? '' : 's' ) ?></strong></div>
				</div>

				<div class="job-list">
					<?php

					if ( have_posts() ) :
						// Start the Loop.
						while ( have_posts() ) : the_post(); 
							?>
					<div class="entry-job">
						<div class="job-title">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>
						<div class="job-excerpt">
							<div class="job-info">
								<?php 

								$job_categories = get_the_terms( get_the_ID(), 'job_cat' );
								if ( !empty( $job_categories ) ) {
									$job_cats = array();
									foreach ( $job_categories as $job_cat ) {
										$job_cats[] = $job_cat->name;
									}
									print "<h5>Job Category:</h5>";
									print "<p>" . implode( ', ', $job_cats ) . "</p>";
								}

								?>
							</div>
							<?php the_excerpt(); ?>
						</div>
					</div>
							<?php
						endwhile;
					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );
					endif;
					?>
				</div>
			</div>

		</div>

	</div><!-- #content -->

<?php

get_footer();

?>