<?php
/*
Home/catch-all template
*/


get_header(); 

the_page_header( "Wooster News", get_bloginfo('template_url') . '/img/bg-header-news.jpg' );

?>

	<div class="content-wide" role="main">
		<div class="wrap">

			<div class="article-filters">
				<div class="article-filter">
					<h3>Browse by Category</h3>
					<div class="browse-by-category">
						<?php wp_dropdown_categories( array( 'show_option_all' => 'Select Category', 'value_field' => 'slug', 'class' => 'category-select', 'orderby' => 'name', 'exclude' => get_field( 'exclude', 'option' ) ) ); ?>
					</div>
				</div>
				<div class="article-filter">
					<h3>Browse by Date</h3>
					<div class="browse-by-date">
						<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
							<option value="">Select Month</option>
							<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
						</select>
					</div>
				</div>
			</div>

			<div class="article-cards blog-listing">
			<?php 
			if ( have_posts() ) : 

				// Start the Loop.
				$count = 0;
				while ( have_posts() ) : the_post();
			        $categories = get_the_category();
			        $cat = $categories[0];
		        	?>
		       	<div class="entry">
		        	<div class="thumbnail">
		        		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( null, array( 500, 500 ) ); ?></a>
			   		</div>
		        	<div class="entry-inner">
			    		<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
			    		<?php the_excerpt(); ?>
			    	</div>
			    </div>
				    <?php
					$count++;
				endwhile;

			else :

				print "<p>There are currently no posts to list here.</p>";

			endif;
			?>		
			</div>

			<div class="pagination">
				<?php pagination(); ?>
			</div>

		</div>

	</div><!-- #primary -->


<?php get_footer(); ?>