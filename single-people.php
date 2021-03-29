<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$education = get_cmb_value( "person_education" );
$courses = get_cmb_value( "person_courses" );

the_page_header();

?>

	<div class="two-column bio">

		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				global $post;
				?>
		<div class="sidebar">
			<?php the_post_thumbnail() ?>
			<div class="person-info">
				<h3><?php the_title(); ?></h3>
				<p class="pronouns">Pronouns: <?php print get_cmb_value( "person_pronouns" ); ?></p>
				<h5 class="person-title"><?php print get_cmb_value( "person_title" ); ?></h5>
				<p><a href="mailto:<?php print get_cmb_value( "person_email" ); ?>"><?php print get_cmb_value( "person_email" ); ?></a></p>
				<p>Phone: <?php print get_cmb_value( "person_phone" ); ?></p>
				<?php if ( has_cmb_value( "person_office" ) ) { ?><p>Office: <?php print get_cmb_value( "person_office" ); ?></p><?php } ?>
				<?php if ( has_cmb_value( "person_website" ) ) { ?><p>Website: <a href='<?php show_cmb_value( "person_website" ) ?>' target='_blank'>Visit Website</a></p><?php } ?>
				<?php if ( has_cmb_value( "person_cv" ) ) { ?><p>CV/Resume: <a href='<?php show_cmb_value( "person_cv" ) ?>' target='_blank'>Download</a></p><?php } ?>
				<p class="cv-link"><a href="/faculty/ask?username=<?php print $post->post_name; ?>" class="btn red-dark">Ask a Question</a></p>
			</div>
		</div>
		<div class="right-column">
			<div class="bio-content">
				<?php the_content(); ?>
			</div>

			<?php if ( get_cmb_value( 'person_interests' ) ) do_accordion( 'Areas of Interest', get_cmb_value( 'person_interests' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_courses' ) ) do_accordion( 'Courses Taught', get_cmb_value( 'person_courses' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_independent' ) ) do_accordion( 'Independent Study Advising', get_cmb_value( 'person_independent' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_publications' ) ) do_accordion( 'Publications', get_cmb_value( 'person_publications' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_presentations' ) ) do_accordion( 'Presentations', get_cmb_value( 'person_presentations' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_experience' ) ) do_accordion( 'Professional Experience', get_cmb_value( 'person_experience' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_affiliations' ) ) do_accordion( 'Professional Affiliations', get_cmb_value( 'person_affiliations' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_awards' ) ) do_accordion( 'Awards', get_cmb_value( 'person_awards' ), 'blue' ); ?>
			<?php if ( get_cmb_value( 'person_production_credits' ) ) do_accordion( 'Production Credits', get_cmb_value( 'person_production_credits' ), 'blue' ); ?>
		</div>
			<?php
			endwhile;
		endif;
		 ?>

	</div><!-- #primary -->
<?php

get_footer();

?>