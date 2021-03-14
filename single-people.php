<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$education = get_cmb_value( "person_education" );
$courses = get_cmb_value( "person_courses" );

?>
	<div class="page-header" style="background-image: url(<?php bloginfo(); ?>/img/)">
		<div class="page-header-overlay"></div>
		<div class="breadcrumbs">
			<div class="crumbs">
				<a href="/faculty">Faculty &amp; Staff</a> &raquo; 
			</div>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="two-column faculty">

		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				?>
		<div class="sidebar">
			<div class="person-info">
				<?php the_post_thumbnail() ?>
				<div class="person-info-inner">
					<h2><?php the_title(); ?></h2>
					<h4 class="person-title"><?php print get_cmb_value( "person_title" ); ?></h4>
					<p><a href="mailto:<?php print get_cmb_value( "person_email" ); ?>"><?php print get_cmb_value( "person_email" ); ?></a><br>
					<?php print get_cmb_value( "person_phone" ); ?></p>
					<?php if ( has_cmb_value( "person_office" ) ) { ?><p>Office: <?php print get_cmb_value( "person_office" ); ?></p><?php } ?>
					<?php if ( has_cmb_value( "person_website" ) ) { ?><p><a href='" . get_cmb_value( "person_website" ) . "' target='_blank'>Website</a></p><?php } ?>
					<p class="cv-link"><a href="<?php show_cmb_value( "person_cv" ); ?>" class="btn red-dark">View CV/Resume</a></p>
				</div>
			</div>
		</div>
		<div class="right-column">
			<div class="faculty-content">
				<?php the_content(); ?>
			</div>
		</div>
			<?php
			endwhile;
		endif;
		 ?>

	</div><!-- #primary -->
<?php

get_footer();

?>