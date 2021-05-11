<?php
/*
Home/catch-all template
*/

get_header(); 


$query_args['post_type'] = ( isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : array( 'post', 'page', 'event', 'job' ) );
$query_args['posts_per_page'] = 40;
$query_args['s'] = $_REQUEST['s'];
$query_args['paged'] = $_REQUEST['paged'];
query_posts( $query_args );

if ( $paged > 0 ) {
	$result_range_start = ( ( $paged - 1 ) * 40 ) + 1;
	$result_range_end = ( $result_range_start + 39 );
	if ( $wp_query->found_posts > $result_range_end ) {
		$result_range = $result_range_start . ' - ' . $result_range_end; 
	} else {
		$result_range = $result_range_start . ' - ' . $wp_query->found_posts;
	}
} else {
	if ( $wp_query->found_posts > 40 ) {
		$result_range = '1 - 40';
	} else {
		$result_range = '1 - ' . $wp_query->found_posts;
	}
}

?>
	<div id="primary" class="site-content">

		<?php the_page_header( "Search: <span>'" . htmlspecialchars( $_REQUEST["s"] ) . "'</span>", get_bloginfo('template_url') . '/img/bg-papers.webp' ) ?>
		
		<div id="content" class="wrap content-wide search-list" role="main">
			<?php include( 'searchform-advanced.php' ); ?>
			<hr />
			<div class="quiet total-results">
				Found <strong><?php echo $wp_query->found_posts; ?></strong> total results. Showing results <strong><?php print $result_range; ?></strong>.
			</div>
			<div class="entries">
			<?php
			if ( have_posts() ) {
				$count = 1;
				while ( have_posts() ) : the_post();
					?>
					<div class="entry <?php print $post->post_type ?>">
						<div class="description">
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<?php 

							// output the excerpt
							the_excerpt();
							
							$categories = get_the_category();
							if ( !empty( $categories ) ) { 
								?>
							<span class="quiet">Posted in </span> 
							<div class="post-category">
								<?php print get_cat_name( $categories[0]->term_id ); ?>
							</div>
							<span class="quiet">on <strong><?php print get_the_date( 'F jS, Y' ); ?></strong></span>
								<?php
							}

							?>
						</div>
					</div>
					<?php
					$count++;
				endwhile;
				?>
				<?php
			} else {
				print "<p>Sadly, your search returned no results. Please try another or navigate using the main menu.</p>";
			}
			?>
			</div>
		</div><!-- #content -->
		<div class="pagination">
			<?php pagination(); ?>
		</div>
	</div><!-- #primary -->
<?php 


get_footer();

