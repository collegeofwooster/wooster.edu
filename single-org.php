<?php

get_header();

?>
	<div class="page-header gold" style="background-image: url(<?php print get_bloginfo('template_url') ?>/img/bg-page-header-org.webp);">
		<div class="page-header-overlay"></div>
        <div class="wrap">
    		<div class="breadcrumbs">
    			<div class="crumbs">
    				<a href="/campus">Life at Wooster</a> &raquo; <a href="/orgs">Student Organizations</a> &raquo;
    			</div>
    			<h1 class="page-title"><?php the_title() ?></h1>
    		</div>
        </div>
	</div>

	<div class="two-column" role="main">
		<div class="wrap">
			<div class="sidebar">
				<a href="/orgs" class="btn gold">&laquo; View All Orgs</a>
				<?php wp_nav_menu( array( 'theme_location' => 'student-organizations' ) ); ?>
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