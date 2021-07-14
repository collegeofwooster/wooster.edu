<?php

get_header();

the_page_header( null, '/wp-content/themes/wooster/img/bg-page-header-org.webp', 'rose' );

?>

<div class="two-column" role="main">
	<div class="wrap">
		<div class="sidebar">
			<a href="/orgs" class="btn gold">&laquo; View All Orgs</a>
			<?php the_sidebar_menu(); ?>
		</div>
		<div class="right-column">
		<?php 
		
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				the_content();
				the_accordions();
			endwhile;
		endif;

		?>
		</div>
	</div>
</div><!-- #content -->

<?php

the_phototiles();

get_footer();

?>