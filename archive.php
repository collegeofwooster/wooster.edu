<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

if ( is_day() ) :
	$page_title = 'Daily Archives: <span>' . get_the_date() . '</span>';
	$page_subtitle = get_snippet( 'header-news' );

elseif ( is_month() ) :
	$page_title = 'Monthly Archives: <span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) . '</span>' ;
	$page_subtitle = get_snippet( 'header-news' );

elseif ( is_year() ) :
	$page_title = 'Yearly Archives: <span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) . '</span>';
	$page_subtitle = get_snippet( 'header-news' );

elseif ( is_category() ) :
	$category = get_queried_object();
	$page_title = "Category:" . $category->name;
	$page_subtitle = ( !empty( $category->category_description ) ? $category->category_description : '&nbsp;' );

elseif ( is_tag() ) :
	$tag_info = get_queried_object();
	$page_title = "<span>Tag:</span> " . $tag_info->name;
	$page_subtitle = ( !empty( $tag_info->description ) ? $tag_info->description : '&nbsp;' );

else :
	$page_title = 'Archives';

endif;

the_page_header( $page_title, get_bloginfo('template_url') . '/img/bg-header-news.webp' );

?>

	<div class="content-wide" role="main">
		<div class="wrap">

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

		</div>
	</div><!-- #primary -->

<?php

get_footer();

?>