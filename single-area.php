<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$education = get_cmb_value( "person_education" );
$courses = get_cmb_value( "person_courses" );

?>
	<div class="page-header area-header"<?php print ( has_cmb_value( 'page_header_background' ) ? ' style="background-image: url(' . get_cmb_value( 'page_header_background' ) . ')"' : ( !empty( $featured_image_url ) ? ' style="background-image: url(' . $featured_image_url . ')"' : '' ) ); ?>>
		<div class="page-header-overlay"></div>
		<div class="breadcrumbs">
			<div class="crumbs"><a href="/academics">Academics</a> &raquo; <a href="/areas">Areas of Study</a> &raquo;</div>
			<div class="page-title"><?php the_title(); ?></div>
			<div class="area-categories">
			<?php
			if ( !empty( $categories ) ) {
				?><?php
				$cats = array();
				foreach ( $categories as $cat ) {
		 			switch ( $cat->slug ) {
		 				case "major":
		 					$cats[] = '<span class="ma">MA</span>';
		 				break;
		 				case "minor":
		 					$cats[] = '<span class="mi">MI</span>';
		 				break;
		 				case "pre-professional-advising":
		 					$cats[] = '<span class="pa">PA</span>';
		 				break;
		 				case "teaching-certification":
		 					$cats[] = '<span class="tc">TC</span>';
		 				break;
		 				case "dual-degree":
		 					$cats[] = '<span class="dd">DD</span>';
		 				break;
		 			}
				}
				print implode( ' ', $cats );
				?><?php
			}
			?>
			</div>
		</div>
	</div>

	<div class="two-column area group" role="main">

	<?php 
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			?>
		<div class="sidebar tab-nav">
			<ul>
				<li class="area-overview">Overview</li>
				<?php do_area_tab_nav( "Major", "major" ) ?>
				<?php do_area_tab_nav( "Minor", "minor" ) ?>
				<?php do_area_tab_nav( "Independent Study", "independent_study" ) ?>
				<?php do_area_tab_nav( "Certifications", "certifications" ) ?>
				<?php do_area_tab_nav( "Licensure", "licensure" ) ?>
				<?php do_area_tab_nav( "Alumni", "alumni" ) ?>
				<?php do_area_tab_nav( "Student Organizations", "student_organizations" ) ?>
				<?php do_area_tab_nav( "Prizes & Scholarships", "scholarships" ) ?>
				<?php do_area_tab_nav( "Lectures", "lectures" ) ?>
				<?php do_area_tab_nav( "Seminar Series", "seminar_series" ) ?>
				<?php do_area_tab_nav( "Lab Facilities", "lab_facilities" ) ?>
				<?php do_area_tab_nav( "Clinics", "clinics" ) ?>
				<?php do_area_tab_nav( "Fern Valley Field Station", "fern_valley" ) ?>
			</ul>
		</div>
		
		<div class="right-column">

			<div class="tab-content active area-overview">
				<h2>Overview</h2>

				<div class="area-columns">
					<div class="column">
						<?php the_content(); ?>
					</div>
					<?php if ( has_cmb_value( 'area_video' ) ) { ?>
					<div class="column">
						<?php print apply_filters( 'the_content', get_cmb_value( 'area_video' ) ); ?>
					</div>
					<?php } ?>
				</div>
				<hr />

				<?php if ( has_cmb_value( 'area_faculty_list' ) ) { ?>
				<h2>Faculty</h2>
				<div class="area-faculty">
					<?php print do_shortcode( '[people category="' . get_cmb_value( 'area_faculty_list' ) . '" /]' ); ?>
				</div>

				<hr />
				<?php } ?>

				<?php if ( !empty( get_cmb_value( 'area_post_tag' ) ) ) { ?>
				<div class="area-news">
					<h2>Latest News</h2>

					<div class="article-cards">						  
					<?php
					$args = array(
					    'tag' => get_cmb_value( 'area_post_tag' ),
					    'posts_per_page' => 3
					);
					$query = new WP_Query( $args );


					// Check that we have query results.
					if ( $query->have_posts() ) {
					  
					    // Start looping over the query results.
					    while ( $query->have_posts() ) {
					        $query->the_post(); ?>
					        <div class="entry">
					        	<?php the_post_thumbnail(); ?>
					        	<div class="entry-inner">
						        	<h4><?php the_title(); ?></h4>
						        	<?php the_excerpt(); ?>
						        </div>
					        </div>
					  		<?php
					    }
					  
					}
					  
					// Restore original post data.
					wp_reset_postdata();
					  
					?>
					</div>
				</div>
				<?php } ?>

			</div>

			<?php do_area_tab_content( "Major", "major" ); ?>
			<?php do_area_tab_content( "Minor", "minor" ); ?>
			<?php do_area_tab_content( "Independent Study", "independent_study" ); ?>
			<?php do_area_tab_content( "Certifications", "certifications" ); ?>
			<?php do_area_tab_content( "Licensure", "licensure" ); ?>
			<?php do_area_tab_content( "Alumni", "alumni" ); ?>
			<?php do_area_tab_content( "Student Organizations", "student_organizations" ); ?>
			<?php do_area_tab_content( "Prizes & Scholarships", "scholarships" ); ?>
			<?php do_area_tab_content( "Lectures", "lectures" ); ?>
			<?php do_area_tab_content( "Seminar Series", "seminar_series" ); ?>
			<?php do_area_tab_content( "Lab Facilities", "lab_facilities" ); ?>
			<?php do_area_tab_content( "Clinics", "clinics" ); ?>
			<?php do_area_tab_content( "Fern Valley Field Station", "fern_valley" ); ?>

		<?php
		endwhile;
	endif;
	 ?>
		</div>

	</div>
<?php

get_footer();

?>