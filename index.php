<?php
/*
Home/catch-all template
*/


// parse the query string
$request = parse_query_string();

// lets globalize the wp_query var
global $wp_query;

// set the args based on current query
$args = $wp_query->query_vars;
$args['posts_per_page'] = 16;
$args['cat'] = '-1105,-1106,-1066,-644,-945,-690,-1292,-1328,-1364,-1419,-1474,-1587,-1592,-1599,-1610,-1644,-1645';

// rerun the query
query_posts( $args );


get_header(); 

the_page_header( "Wooster News", get_bloginfo('template_url') . '/img/bg-header-news.jpg' );

?> 

	<div class="content-wide" role="main">
		<div class="wrap">

			<div class="article-filters">
				<div class="article-filter">
					<h3>Browse by Category</h3>
					<div class="browse-by-category">
						<?php wp_dropdown_categories( array( 'show_option_all' => 'Select Category', 'value_field' => 'slug', 'class' => 'category-select', 'orderby' => 'name', 'exclude' => array( 1105, 1106, 1066, 644, 945, 690, 1292, 1328, 1364, 1419, 1592, 1599, 1610, 1644, 1645 ) ) ); ?>
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