<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

$org_cats = get_org_categories();

?>
	<div class="page-header gold" style="background-image: url(<?php print get_bloginfo('template_url') ?>/img/bg-page-header-org.webp);">
		<div class="page-header-overlay"></div>
        <div class="wrap">
    		<div class="breadcrumbs">
    			<div class="crumbs">
    				<a href="/campus">Life at Wooster</a> &raquo;
    			</div>
    			<h1 class="page-title">Student Organizations</h1>
    		</div>
        </div>
	</div>

	<div class="content-wide" role="main">
		<div class="wrap">

			<div class="org-listing">
				<?php 
				foreach ( $org_cats as $org_cat ) {
					?>
				<div class="org-category">
				 	<h4><?php print $org_cat->name; ?></h4>
					<ul class="org-list">
					<?php
					query_posts( 'post_type=org&org_cat=' . $org_cat->slug . '&orderby=title&order=ASC&posts_per_page=0' );
					while ( have_posts() ) : the_post();
						print '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					endwhile;
					?>
					</ul>
				</div>
					<?php 
				} 
				?>
			</div>

		</div>
	</div><!-- #primary -->

<?php

get_footer();

?>