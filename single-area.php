<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$education = get_cmb_value( "person_education" );
$courses = get_cmb_value( "person_courses" );

?>
	<div class="page-header area-header"<?php print ( !empty( $featured_image_url ) ? ' style="background-image: url(' . $featured_image_url . ')"' : '' ); ?>>
		<div class="page-header-overlay"></div>
		<div class="breadcrumbs">
			<div class="crumbs"><a href="/academics">Academics</a> &raquo; <a href="/areas-of-study">Areas of Study</a> &raquo;</div>
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
			<!--<button class="back-to-areas">Back to All Areas</button>-->
			<div class="sidebar tab-nav">
				<ul>
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
					<?php the_content(); ?>

					<hr />

					<?php if ( !empty( get_cmb_value( 'area_post_tag' ) ) ) { ?>
					<div class="area-news">
						<h2>Latest News</h2>						  
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
						        	<h3><?php the_title(); ?></h3>
						        	<?php the_excerpt(); ?>
						        </div>
						  		<?php
						    }
						  
						}
						  
						// Restore original post data.
						wp_reset_postdata();
						  
						?>
					</div>
					<?php } ?>

				</div>

				<div class="tab-content area-faculty">
					<h2>Faculty</h2>

					<?php 
					$faculty_query = new WP_Query( array(
						"post__in" => $faculty,
						"post_type" => 'faculty',
						"posts_per_page" => -1,
						"order" => "ASC",
						"orderby" => "title"
					) );

					if ( $faculty_query->have_posts() ) : 
						?>

					<div class="area-faculty">
					<?php

						// Start the Loop.
						while ( $faculty_query->have_posts() ) : $faculty_query->the_post();
							?>
							<div class="faculty-entry">
								<a href="<?php the_permalink(); ?>">
								<div class="photo" style="background-image: url(<?php the_post_thumbnail_url( array( 500, 500 ) ); ?>);"></div>
								<div class="info">
									<h4><?php the_title(); ?></h4>
									<p class="faculty-title"><?php print get_cmb_value( "faculty_title" ); ?></p>
								</div>
								</a>
							</div>
							<?php

						endwhile;

						?>
					</div>
					<?php
					endif;

					wp_reset_query();
					
					?>

				</div>

				<?php do_area_tab_content( "Major", "major" ) ?>
				<?php do_area_tab_content( "Minor", "minor" ) ?>
				<?php do_area_tab_content( "Independent Study", "independent_study" ) ?>
				<?php do_area_tab_content( "Certifications", "certifications" ) ?>
				<?php do_area_tab_content( "Licensure", "licensure" ) ?>
				<?php do_area_tab_content( "Alumni", "alumni" ) ?>
				<?php do_area_tab_content( "Student Organizations", "student_organizations" ) ?>
				<?php do_area_tab_content( "Prizes & Scholarships", "scholarships" ) ?>
				<?php do_area_tab_content( "Lectures", "lectures" ) ?>
				<?php do_area_tab_content( "Seminar Series", "seminar_series" ) ?>
				<?php do_area_tab_content( "Lab Facilities", "lab_facilities" ) ?>
				<?php do_area_tab_content( "Clinics", "clinics" ) ?>
				<?php do_area_tab_content( "Fern Valley Field Station", "fern_valley" ) ?>
			<?php
			endwhile;
		endif;
		 ?>
		</div>

	</div>
<?php

get_footer();

?>