<?php
/**
 * The Template for displaying all single posts
 */

get_header();

?>

	<?php 
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>
	<div class="post-columns" role="main">
		<h1><?php the_title(); ?></h1>
		<div class="post-columns-inner">
			<div class="wrap">
				<div class="main-content">
					<?php 
					the_post_thumbnail( 'full' );
					the_content();
					?>
					<p class="quiet">Posted in <?php print get_the_category_list( ', ' ) ?>.</p>
				</div>
				<div class="aside">
				<?php
				
				$cat_list = wp_get_post_categories( $post->ID );
				$related_posts = get_posts( array(
					'post_type' => 'post',
					'cat__in' => $cat_list,
					'posts_per_page' => 3
				) );
				if ( !empty( $cat_list ) ) {
					?>
					<h3>Related Posts</h3>
					<div class="articles list">
					<?php
					foreach ( $related_posts as $rpost ) {
						?>
						<div class="article">
							<?php print get_the_post_thumbnail( $rpost->ID, 'thumbnail' ); ?>
							<h4><a href="<?php print get_the_permalink( $rpost->ID ) ?>"><?php print $rpost->post_title ?></a></h4>
						</div>
						<?php
					}
					?>
					</div>
					<?php
				}

				$tags = wp_get_post_tags( $post->ID );
				$tag_array = array();
				foreach ( $tags as $t ) {
					$tag_array[] = str_replace( '-2', '', $t->slug );
				}

				if ( !empty( $tag_array ) ) {
					$areas = get_posts( array(
						'post_type' => 'area',
						'post_name__in' => $tag_array
					) );
					?>
					<br>
					<h3>Related Areas of Study</h3>
					<div class="areas list">
					<?php
					foreach ( $areas as $a ) {
						$cats = get_area_cats( $a->ID );
						?>
						<div class="entry area">
							<a href="/area/<?php print $a->post_name ?>/"><h4><?php print $a->post_title ?></h4></a>
							<p><?php print get_the_excerpt( $a->ID ); ?></p>
							<?php print implode( ' ', $cats ); ?>
						</div>
						<?php
					}
					?>
					</div>
					<?php
				}
					
				?>
					<br>
					<h3>Connect with Wooster</h3>
					<?php wp_nav_menu( array( 'menu' => 'connect-with-wooster' ) ); ?>

				</div>
			</div>
		</div>
				<?php
			endwhile;
		endif;
		?>
	</div>

<?php

get_footer();

?>